<?php
session_start();
include('conexion.php');
if(isset($_SESSION['usuarioingresando']))
{
	header('location: principal.php');
}
?>
<html>
<head>
<title>VaidrollTeam</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="FormCajaLogin">

<div class="FormLogin">
<form method="post">
<h1>Crear nueva cuenta</h1>
<br>

<div class="TextoCajas">• Ingresar nombre</div>
<input type="text" name="txtnombre" class="CajaTexto" required>

<div class="TextoCajas">• Ingresar correo</div>
<input type="email" name="txtcorreo" class="CajaTexto" required>

<div class="TextoCajas">• Ingresar password</div>
<input type="password" id="txtpassword" name="txtpassword" class="CajaTexto" required>
 
<div class="CheckBox1">
<input type="checkbox" onclick="verpassword()" >Mostrar password
</div>
 
<div>
<input type="submit" value="Crea nueva cuenta" class="BtnRegistrar" name="btnregistrar">
</div>
<hr>
<br>
<div >
<a href="index.php" class="BtnLogin">Regresar</a>
</div>

</div>
</form>
</div>
 
</body>
<script>
  function verpassword(){
      var tipo = document.getElementById("txtpassword");
      if(tipo.type == "password")
	  {
          tipo.type = "text";
      }
	  else
	  {
          tipo.type = "password";
      }
  }
</script>
</html>
<?php

if(isset($_POST["btnregistrar"]))
{

$nombre = $_POST["txtnombre"];
$correo = $_POST["txtcorreo"];
$pass 	= $_POST["txtpassword"];


$insertarusu = mysqli_query($conn,"INSERT INTO usuarios(nom,correo,pass) values ('$nombre','$correo','$pass')");
	
if(!$insertarusu)
{
echo "<script>alert('Correo duplicado, intenta con otro correo');</script>";
		 
}
else
{
echo "<script> alert('Usuario registrado con exito: $nombre'); window.location='index.php' </script>";
}
} 
?>
barra_lateral.php
<?php
session_start();
include('conexion.php');
if(isset($_SESSION['usuarioingresando']))
{
$usuarioingresado = $_SESSION['usuarioingresando'];
$buscandousu = mysqli_query($conn,"SELECT * FROM usuarios WHERE correo = '".$usuarioingresado."'");
$mostrar=mysqli_fetch_array($buscandousu);
	
}else
{
	header('location: index.php');
}

?>

<html>
<head>
<title>VaidrollTeam</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
	
</head>
<body>
<div class="BarraLateral">
<ul>
<div class="NomUsuario"><?php echo $mostrar['nom']?></div>
<hr>
<li><a href="principal.php" >Inicio</a></li>
<li><a href="usuarios_tabla.php" >Usuarios</a></li>
<li><a href="cerrar_sesion.php" >Cerrar sesión</a></li>
</ul>
</div>
</body>
</html>
principal.php
<?php

include('conexion.php');
include('barra_lateral.php');

$usuarioingresado = $_SESSION['usuarioingresando'];
$buscandousu = mysqli_query($conn,"SELECT * FROM usuarios WHERE correo = '".$usuarioingresado."'");
$mostrar=mysqli_fetch_array($buscandousu);

?>

<html>
<title>VaidrollTeam</title>
<script>
		function verhorafor12() {
			var fecha = new Date();
			var hora = fecha.getHours();
			var minutos = fecha.getMinutes();
			var segundos = fecha.getSeconds();
			var dianoche = "AM";
			if (hora > 12) {
				hora = hora - 12;
				dianoche = "PM";
			}
			if (hora === 0) {
				hora = 12;
			}
			var tothora = hora + ":" + minutos + ":" + segundos + " " + dianoche;
			document.getElementById("hora").innerHTML = tothora;
		}
	</script>
<body onload="setInterval(verhorafor12, 1000);" >
<div class="ContenedorPrincipal">	
<div>
<h1><?php echo "Bienvenido: ".$mostrar['nom'];?></h1>
<h2><?php echo "Correo: ".$mostrar['correo'];?></h2>
<h3>La hora del sistema es: <span id="hora"></span></h3>
</div>
</div>
</body>
</html>
usuarios_tabla.php
<?php
include('conexion.php');
include("barra_lateral.php");
?>
<html>
<title>VaidrollTeam</title>
<body>
<div class="ContenedorPrincipal">	
<?php
 
    $filasmax = 5;
 
    if (isset($_GET['pag'])) 
	{
        $pagina = $_GET['pag'];
    } else 
	{
        $pagina = 1;
    }
 
 if(isset($_POST['btnbuscar']))
{
$buscar = $_POST['txtbuscar'];

 $sqlusu = mysqli_query($conn, "SELECT * FROM usuarios where correo = '".$buscar."'");

}
else
{
 $sqlusu = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY nom ASC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
}
 
    $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_usuarios FROM usuarios");
 
    $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_usuarios'];
	
    ?>
	<div class="ContenedorTabla" >
	<form method="POST">
	<h1>Lista de usuarios</h1>
	
	<div style="text-align:left">
	<a href="usuarios_tabla.php" class="BotonesUsuarios">Inicio de la tabla</a>
	
	<input class="BotonesUsuarios" type="submit" value="Buscar" name="btnbuscar">
	<input class="CajaTexto" type="text" name="txtbuscar"  placeholder="Ingresar correo" autocomplete="off" style='width:20%'>
	</div>
			</form>
    <table>
			<tr>
			<th>Nombre</th>
			<th>Correo</th>
                        <th>Password</th>
			<th>Acción</th>
			</tr>
 
        <?php
 
        while ($mostrar = mysqli_fetch_assoc($sqlusu)) 
		{
			
            echo "<tr>";
            echo "<td>".$mostrar['nom']."</td>";
			echo "<td>".$mostrar['correo']."</td>";
			 echo "<td>***</td>";
            // echo "<td>".$mostrar['pass']."</td>";    
            echo "<td style='width:24%'>
			<a class='BotonesUsuarios' href=\"usuarios_ver.php?correo=$mostrar[correo]&pag=$pagina\">Ver</a> 
			<a class='BotonesUsuarios' href=\"usuarios_modificar.php?correo=$mostrar[correo]&pag=$pagina\">Modificar</a> 
			<a class='BotonesUsuarios' href=\"usuarios_eliminar.php?correo=$mostrar[correo]&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar a $mostrar[nom]?')\">Eliminar</a>
			</td>";  
			
        }
 
        ?>
    </table>
	<div style='text-align:right'>
	<br>
	<?php echo "Total de usuarios: ".$maxusutabla;?>
	</div>
	</div>
<div style='text-align:right'>
<br>
</div>
<div style="text-align:center">
<?php
if (isset($_GET['pag'])) {
if ($_GET['pag'] > 1) {
 ?>
<a class="BotonesUsuarios" href="usuarios_tabla.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
<?php
} 
else 
{
?>
<a class="BotonesUsuarios" href="#" style="pointer-events: none">Anterior</a>
<?php
}
?>
 
 <?php
} 
else 
{
?>
<a class="BotonesUsuarios" href="#" style="pointer-events: none">Anterior</a>
<?php
}
 
if (isset($_GET['pag'])) {
if ((($pagina) * $filasmax) < $maxusutabla) {
?>
<a class="BotonesUsuarios" href="usuarios_tabla.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
<?php
} else {
?>
<a class="BotonesUsuarios" href="#" style="pointer-events: none">Siguiente</a>
<?php
}
?>
<?php
} else {
?>
<a class="BotonesUsuarios" href="usuarios_tabla.php?pag=2">Siguiente</a>
<?php
}
?>
</div>
</div>
</body>
</html>
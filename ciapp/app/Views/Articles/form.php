<label for="title">Título</label>
<input type="text" id="title" name="title" value="<?= old ("title", esc($article->title)) ?>">

<label for="content">Contenido</label>
<textarea id="content" name="content"><?= old("content", esc($article->content)) ?></textarea>

<button>Guardar</button>
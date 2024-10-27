<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Artículo eliminado<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Eliminar Artículo</h1>

<p>¿Está seguro de eliminarlo?</p>

<?= form_open("Articles/delete" . $article->id) ?>

<button>Si</button>

</form>

<?= $this->endSection() ?>
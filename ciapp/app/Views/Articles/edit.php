<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Editar Artículo<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Editar artículo</h1>

<?php if (session()->has("errors")): ?>

    <ul>
        <?php foreach(session("errors") as $error): ?>
            <li><?= $error ?></li>
            <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open("Articles/update/" .$article->id) ?>

<?= $this->include("Articles/form") ?>


</form>

<?= $this->endSection() ?>
<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Nuevo Artículo<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Nuevo artículo</h1>

<?php if (session()->has("errors")): ?>

    <ul>
        <?php foreach(session("errors") as $error): ?>
            <li><?= $error ?></li>
            <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open("Articles/create") ?>

<?= $this->include("Articles/form") ?>

</form>

<?= $this->endSection() ?>
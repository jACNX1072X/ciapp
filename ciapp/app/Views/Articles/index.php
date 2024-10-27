        <?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Articles<?= $this->endSection() ?>

<?= $this->section("content") ?>

        <h1>Artículos</h1>

        <a href="<?= url_to('Articles::new') ?>">Nuevo</a>


        <?php foreach ($articles as $article): ?>

            <article>
                <h2><a href="<?= site_url('/Articles/' .$article->id) ?>"><?= esc($article->title) ?></a></h2>
                <p><?= esc($article->content) ?></p>
            </article>
        <?php endforeach; ?>

<?= $this->endSection() ?>

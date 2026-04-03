<article class="project-detail">
    <h1><?= e($project['title']) ?></h1>
    <p class="muted">Catégorie : <?= e($project['category_name']) ?></p>
    <p><?= e($project['summary']) ?></p>

    <section>
        <h2>Contenu</h2>
        <div>
            <?= rich($project['content']) ?>
        </div>
    </section>

    <section>
        <h2>Étiquettes</h2>
        <?php if (empty($tags)): ?>
            <p>Aucune étiquette.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($tags as $tag): ?>
                    <li><?= e($tag['name']) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

    <section>
        <h2>Images</h2>
        <?php if (empty($images)): ?>
            <p>Aucune image.</p>
        <?php else: ?>
            <div class="image-grid">
                <?php foreach ($images as $image): ?>
                    <figure>
                        <img src="<?= e($this->config['app']['base_url']) ?>/uploads/<?= e($image['picture']) ?>" alt="<?= e($image['alt']) ?>">
                    </figure>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <p><a href="<?= e($this->config['app']['base_url']) ?>/">← Retour à l'accueil</a></p>
</article>

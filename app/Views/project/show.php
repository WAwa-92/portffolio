<article class="project-detail">
    <p class="muted"><?= e($project['category_name']) ?></p>
    <h1><?= e($project['title']) ?></h1>
    <p><?= e($project['summary']) ?></p>

    <?php if (!empty($images)): ?>
        <div class="image-grid" style="margin: 1.5rem 0;">
            <?php foreach ($images as $image): ?>
                <figure>
                    <img src="<?= e($this->config['app']['base_url']) ?>/images/<?= e($image['picture']) ?>" alt="<?= e($image['alt']) ?>">
                </figure>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <h2>À propos</h2>
    <div><?= rich($project['content']) ?></div>

    <?php if (!empty($tags)): ?>
        <h2>Technologies</h2>
        <ul>
            <?php foreach ($tags as $tag): ?>
                <li><?= e($tag['name']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p style="margin-top: 2rem;"><a href="<?= e($this->config['app']['base_url']) ?>/">← Retour aux projets</a></p>
</article>

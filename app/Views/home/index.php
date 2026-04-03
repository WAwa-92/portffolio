<section class="hero">
    <h1><?= e($user['name'] ?? 'Votre nom') ?></h1>
    <div><?= rich($user['description'] ?? 'Ajoutez votre description dans le dashboard.') ?></div>

    <?php if (!empty($user['github_url'])): ?>
        <p><a href="<?= e($user['github_url']) ?>" target="_blank" rel="noopener">Mon GitHub</a></p>
    <?php endif; ?>
</section>

<section class="skills">
    <h2>Compétences</h2>
    <?php if (empty($skills)): ?>
        <p>Aucune compétence pour le moment.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($skills as $skill): ?>
                <li><?= e($skill['name']) ?> - niveau <?= e((string) $skill['level']) ?>/100</li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>

<section class="projects">
    <h2>Projets</h2>

    <div class="filters">
        <button type="button" class="filter-btn" data-filter="all">Tous</button>
        <?php foreach ($categories as $category): ?>
            <button type="button" class="filter-btn" data-filter="<?= e((string) $category['id']) ?>">
                <?= e($category['name']) ?>
            </button>
        <?php endforeach; ?>
    </div>

    <div class="project-list">
        <?php foreach ($projects as $project): ?>
            <article class="project-card" data-category="<?= e((string) $project['category_id']) ?>">
                <h3><?= e($project['title']) ?></h3>
                <p class="muted">Catégorie : <?= e($project['category_name']) ?></p>
                <p><?= e($project['summary']) ?></p>
                <a href="<?= e($this->config['app']['base_url']) ?>/project/<?= e((string) $project['id']) ?>">Voir le détail</a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

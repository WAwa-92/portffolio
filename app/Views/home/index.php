<section class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1><?= e($user['name'] ?? 'Votre nom') ?></h1>
            <div class="hero-description"><?= rich($user['description'] ?? '<p>Développeur web en formation.</p>') ?></div>
            <div class="hero-actions">
                <a class="btn-social btn-github" href="https://github.com/WAwa-92" target="_blank" rel="noopener">
                    <i class="fa-brands fa-github"></i> GitHub
                </a>
                <a class="btn-social btn-linkedin" href="https://www.linkedin.com/in/wael-bakkay-95b45a390" target="_blank" rel="noopener">
                    <i class="fa-brands fa-linkedin"></i> LinkedIn
                </a>
            </div>
        </div>

        <img class="hero-avatar hero-avatar-large"
             src="<?= e($this->config['app']['base_url']) ?>/images/waelbakkay.jpeg"
             alt="Photo de <?= e($user['name'] ?? 'utilisateur') ?>"
             onerror="this.style.display='none'">
    </div>
</section>

<section class="skills">
    <h2>Compétences</h2>
    <?php if (empty($skills)): ?>
        <p class="muted">Aucune compétence pour le moment.</p>
    <?php else: ?>
        <ul>
            <?php
            $skillIcons = [
                'HTML/CSS'   => 'fa-brands fa-html5',
                'HTML'       => 'fa-brands fa-html5',
                'CSS'        => 'fa-brands fa-css3-alt',
                'PHP'        => 'fa-brands fa-php',
                'JavaScript' => 'fa-brands fa-js',
                'MySQL'      => 'fa-solid fa-database',
                'SCSS'       => 'fa-brands fa-sass',
                'Git'        => 'fa-brands fa-git-alt',
                'Python'     => 'fa-brands fa-python',
                'React'      => 'fa-brands fa-react',
                'Node.js'    => 'fa-brands fa-node-js',
            ];
            ?>
            <?php foreach ($skills as $skill): ?>
                <?php $icon = $skillIcons[$skill['name']] ?? 'fa-solid fa-code'; ?>
                <li>
                    <span class="skill-label"><i class="<?= $icon ?>"></i> <?= e($skill['name']) ?></span>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" style="width: <?= (int)$skill['level'] ?>%"></div>
                    </div>
                    <span class="skill-percent"><?= (int)$skill['level'] ?>%</span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>

<section class="projects">
    <h2>Projets</h2>

    <div class="filters">
        <button type="button" class="filter-btn active" data-filter="all">Tous</button>
        <?php foreach ($categories as $category): ?>
            <button type="button" class="filter-btn" data-filter="<?= e((string) $category['id']) ?>">
                <?= e($category['name']) ?>
            </button>
        <?php endforeach; ?>
    </div>

    <div class="project-list">
        <?php foreach ($projects as $project): ?>
            <article class="project-card" data-category="<?= e((string) $project['category_id']) ?>">
                <img src="<?= e($this->config['app']['base_url']) ?>/images/<?= e($project['slug']) ?>.png"
                     alt="<?= e($project['title']) ?>"
                     onerror="this.style.display='none'">
                <div class="project-card-body">
                    <p class="muted"><?= e($project['category_name']) ?></p>
                    <h3><?= e($project['title']) ?></h3>
                    <p><?= e($project['summary']) ?></p>
                    <a class="btn-link" href="<?= e($this->config['app']['base_url']) ?>/project/<?= e((string) $project['id']) ?>">Voir le détail →</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

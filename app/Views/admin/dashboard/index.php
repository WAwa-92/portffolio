<section>
    <h1>Dashboard</h1>
    <p>Bienvenue dans l'administration.</p>

    <div class="stats-grid">
        <article class="stat-card">
            <h2><?= e((string) $stats['projects']) ?></h2>
            <p>Projets</p>
        </article>
        <article class="stat-card">
            <h2><?= e((string) $stats['categories']) ?></h2>
            <p>Catégories</p>
        </article>
        <article class="stat-card">
            <h2><?= e((string) $stats['skills']) ?></h2>
            <p>Compétences</p>
        </article>
        <article class="stat-card">
            <h2><?= e((string) $stats['tags']) ?></h2>
            <p>Étiquettes</p>
        </article>
    </div>

    <p>Dans la partie 2, on fera les pages CRUD complètes.</p>
</section>

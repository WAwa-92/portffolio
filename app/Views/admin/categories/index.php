<section>
    <div class="admin-header-row">
        <h1>Catégories</h1>
        <a href="<?= e($this->config['app']['base_url']) ?>/admin/categories/create">+ Nouvelle catégorie</a>
    </div>

    <?php if (empty($categories)): ?>
        <p>Aucune catégorie.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= e((string) $category['id']) ?></td>
                        <td><?= e($category['name']) ?></td>
                        <td class="actions">
                            <a href="<?= e($this->config['app']['base_url']) ?>/admin/categories/<?= e((string) $category['id']) ?>/edit">Modifier</a>
                            <form action="<?= e($this->config['app']['base_url']) ?>/admin/categories/<?= e((string) $category['id']) ?>/delete" method="post" onsubmit="return confirm('Supprimer cette catégorie ?');">
                                <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
                                <button type="submit" class="btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

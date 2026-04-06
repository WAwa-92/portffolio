<section class="auth-card">
    <h1>Modifier une catégorie</h1>

    <form action="<?= e($this->config['app']['base_url']) ?>/admin/categories/<?= e((string) $category['id']) ?>/update" method="post">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <label for="name">Nom</label>
        <input type="text" id="name" name="name" maxlength="50" required value="<?= e($category['name']) ?>">

        <button type="submit">Mettre à jour</button>
    </form>

    <p><a href="<?= e($this->config['app']['base_url']) ?>/admin/categories">← Retour à la liste</a></p>
</section>

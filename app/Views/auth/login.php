<section class="auth-card">
    <h1>Connexion admin</h1>

    <form action="<?= e($this->config['app']['base_url']) ?>/login" method="post">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>
    </form>
</section>

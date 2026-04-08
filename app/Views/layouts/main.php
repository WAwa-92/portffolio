<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(($pageTitle ?? '') . ' - ' . $this->config['app']['name']) ?></title>
    <link rel="stylesheet" href="<?= e($this->config['app']['base_url']) ?>/assets/css/main.css?v=<?= time() ?>">
</head>
<body>
    <header class="site-header">
        <nav class="container nav">
            <a href="<?= e($this->config['app']['base_url']) ?>/" class="logo">Portfolio</a>
            <div class="menu">
                <a href="<?= e($this->config['app']['base_url']) ?>/">Accueil</a>
                <a href="<?= e($this->config['app']['base_url']) ?>/login">Admin</a>
            </div>
        </nav>
    </header>

    <main class="container">
        <?php $flashes = \App\Core\Session::getFlashes(); ?>
        <?php foreach ($flashes as $type => $messages): ?>
            <?php foreach ($messages as $message): ?>
                <p class="flash flash-<?= e($type) ?>"><?= e($message) ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>

        <?= $content ?>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> Portfolio - Tous droits réservés</p>
        </div>
    </footer>

    <script src="<?= e($this->config['app']['base_url']) ?>/assets/js/filter.js"></script>
</body>
</html>

<?php

declare(strict_types=1);

use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\Admin\ProfileController;
use App\Core\Router;
use App\Core\Session;

define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(function (string $className): void {
    $prefix = 'App\\';
    $baseDir = BASE_PATH . '/app/';

    if (!str_starts_with($className, $prefix)) {
        return;
    }

    $relativeClass = substr($className, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

require_once BASE_PATH . '/app/Helpers/functions.php';

$config = require BASE_PATH . '/app/Config/config.php';

// Ajuste automatiquement la base URL selon l'environnement courant
// (ex: MAMP sur :8888/portfolioVF/public ou serveur PHP intégré sur :8130)
if (isset($_SERVER['HTTP_HOST'], $_SERVER['SCRIPT_NAME'])) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $scriptDir = str_replace('\\', '/', dirname((string) $_SERVER['SCRIPT_NAME']));
    $scriptDir = $scriptDir === '/' ? '' : rtrim($scriptDir, '/');
    $config['app']['base_url'] = $scheme . '://' . $_SERVER['HTTP_HOST'] . $scriptDir;
}

Session::start();

$router = new Router($config);

$router->get('/', [HomeController::class, 'index']);
$router->get('/project/{id}', [ProjectController::class, 'show']);

$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout'], true);

$router->get('/admin', [DashboardController::class, 'index'], true);

// Partie 2 - CRUD Catégories (admin)
$router->get('/admin/categories', [CategoryController::class, 'index'], true);
$router->get('/admin/categories/create', [CategoryController::class, 'create'], true);
$router->post('/admin/categories/store', [CategoryController::class, 'store'], true);
$router->get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'], true);
$router->post('/admin/categories/{id}/update', [CategoryController::class, 'update'], true);
$router->post('/admin/categories/{id}/delete', [CategoryController::class, 'delete'], true);

// Partie 2 - Profil utilisateur (WYSIWYG)
$router->get('/admin/profile', [ProfileController::class, 'edit'], true);
$router->post('/admin/profile/update', [ProfileController::class, 'update'], true);

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');

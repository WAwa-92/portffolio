<?php

declare(strict_types=1);

use App\Controllers\Admin\DashboardController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ProjectController;
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

Session::start();

$router = new Router($config);

$router->get('/', [HomeController::class, 'index']);
$router->get('/project/{id}', [ProjectController::class, 'show']);

$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout'], true);

$router->get('/admin', [DashboardController::class, 'index'], true);

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');

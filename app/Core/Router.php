<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $routes = [];

    public function __construct(private array $config)
    {
    }

    public function get(string $path, array $handler, bool $authRequired = false): void
    {
        $this->addRoute('GET', $path, $handler, $authRequired);
    }

    public function post(string $path, array $handler, bool $authRequired = false): void
    {
        $this->addRoute('POST', $path, $handler, $authRequired);
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        if (!$path) {
            $path = '/';
        }

        $basePath = parse_url($this->config['app']['base_url'], PHP_URL_PATH);

        if (!$basePath) {
            $basePath = '';
        }

        if ($basePath !== '' && str_starts_with($path, $basePath)) {
            $path = substr($path, strlen($basePath));

            if ($path === '') {
                $path = '/';
            }
        }

        $availableRoutes = $this->routes[strtoupper($method)] ?? [];

        foreach ($availableRoutes as $route) {
            $params = $this->matchRoute($route['path'], $path);

            if ($params === false) {
                continue;
            }

            if ($route['authRequired'] && !Auth::check()) {
                Session::flash('error', 'Veuillez vous connecter.');
                header('Location: ' . $this->config['app']['base_url'] . '/login');
                exit;
            }

            [$controllerClass, $action] = $route['handler'];
            $controller = new $controllerClass($this->config);

            call_user_func_array([$controller, $action], $params);

            return;
        }

        http_response_code(404);
        $controller = new \App\Controllers\ErrorController($this->config);
        $controller->notFound();
    }

    private function addRoute(string $method, string $path, array $handler, bool $authRequired): void
    {
        $this->routes[strtoupper($method)][] = [
            'path' => $path,
            'handler' => $handler,
            'authRequired' => $authRequired,
        ];
    }

    private function matchRoute(string $routePath, string $currentPath): array|false
    {
        $routeParts = explode('/', trim($routePath, '/'));
        $currentParts = explode('/', trim($currentPath, '/'));

        if ($routePath === '/') {
            $routeParts = [];
        }

        if ($currentPath === '/') {
            $currentParts = [];
        }

        if (count($routeParts) !== count($currentParts)) {
            return false;
        }

        $params = [];

        foreach ($routeParts as $index => $routePart) {
            $currentPart = $currentParts[$index];

            if (str_starts_with($routePart, '{') && str_ends_with($routePart, '}')) {
                $params[] = $currentPart;
                continue;
            }

            if ($routePart !== $currentPart) {
                return false;
            }
        }

        return $params;
    }
}

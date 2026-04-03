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
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $basePath = parse_url($this->config['app']['base_url'], PHP_URL_PATH) ?: '';

        if ($basePath !== '' && str_starts_with($path, $basePath)) {
            $path = substr($path, strlen($basePath));
            $path = $path === '' ? '/' : $path;
        }

        $availableRoutes = $this->routes[strtoupper($method)] ?? [];

        foreach ($availableRoutes as $route) {
            $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if (!preg_match($pattern, $path, $matches)) {
                continue;
            }

            if ($route['authRequired'] && !Auth::check()) {
                Session::flash('error', 'Veuillez vous connecter.');
                header('Location: ' . $this->config['app']['base_url'] . '/login');
                exit;
            }

            [$controllerClass, $action] = $route['handler'];
            $controller = new $controllerClass($this->config);

            $params = array_filter($matches, static fn ($key): bool => !is_int($key), ARRAY_FILTER_USE_KEY);
            $controller->{$action}(...array_values($params));

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
}

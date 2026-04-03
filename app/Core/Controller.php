<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    public function __construct(protected array $config)
    {
    }

    protected function render(string $view, array $data = [], string $layout = 'main'): void
    {
        extract($data, EXTR_SKIP);

        $viewFile = BASE_PATH . '/app/Views/' . $view . '.php';
        $layoutFile = BASE_PATH . '/app/Views/layouts/' . $layout . '.php';

        if (!file_exists($viewFile) || !file_exists($layoutFile)) {
            http_response_code(500);
            exit('Vue introuvable.');
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . $this->config['app']['base_url'] . $path);
        exit;
    }
}

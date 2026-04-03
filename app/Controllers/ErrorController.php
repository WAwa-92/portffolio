<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class ErrorController extends Controller
{
    public function notFound(): void
    {
        $this->render('errors/404', [
            'pageTitle' => 'Page introuvable',
        ]);
    }
}

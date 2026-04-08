<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function show(string $id): void
    {
        if (!is_numeric($id)) {
            http_response_code(404);
            (new ErrorController($this->config))->notFound();
            return;
        }

        $projectModel = new Project($this->config);
        $project = $projectModel->findById((int) $id);

        if (!$project) {
            http_response_code(404);
            (new ErrorController($this->config))->notFound();
            return;
        }

        $tags = $projectModel->getTags((int) $id);
        $images = $projectModel->getImages((int) $id);

        $this->render('project/show', [
            'pageTitle' => 'Détail projet',
            'project' => $project,
            'tags' => $tags,
            'images' => $images,
        ]);
    }
}

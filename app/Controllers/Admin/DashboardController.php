<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function index(): void
    {
        $projectModel = new Project($this->config);
        $categoryModel = new Category($this->config);
        $skillModel = new Skill($this->config);
        $tagModel = new Tag($this->config);

        $projects = $projectModel->allWithCategory();
        $categories = $categoryModel->all();
        $skills = $skillModel->allByUser(Auth::id() ?? 1);
        $tags = [];

        foreach ($projects as $project) {
            $tags = array_merge($tags, $tagModel->allByProject((int) $project['id']));
        }

        $this->render('admin/dashboard/index', [
            'pageTitle' => 'Dashboard',
            'stats' => [
                'projects' => count($projects),
                'categories' => count($categories),
                'skills' => count($skills),
                'tags' => count($tags),
            ],
        ], 'admin');
    }
}

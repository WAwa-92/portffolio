<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;

class HomeController extends Controller
{
    public function index(): void
    {
        $userModel = new User($this->config);
        $skillModel = new Skill($this->config);
        $categoryModel = new Category($this->config);
        $projectModel = new Project($this->config);

        $user = $userModel->findFirst();
        $skills = $user ? $skillModel->allByUser((int) $user['id']) : [];
        $categories = $categoryModel->all();
        $projects = $projectModel->allWithCategory();

        $this->render('home/index', [
            'pageTitle' => 'Accueil',
            'user' => $user,
            'skills' => $skills,
            'categories' => $categories,
            'projects' => $projects,
        ]);
    }
}

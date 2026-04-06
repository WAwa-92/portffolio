<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Category;
use Throwable;

class CategoryController extends Controller
{
    public function index(): void
    {
        $categoryModel = new Category($this->config);

        $this->render('admin/categories/index', [
            'pageTitle' => 'Catégories',
            'categories' => $categoryModel->all(),
            'csrfToken' => Session::csrfToken(),
        ], 'admin');
    }

    public function create(): void
    {
        $this->render('admin/categories/create', [
            'pageTitle' => 'Créer une catégorie',
            'csrfToken' => Session::csrfToken(),
        ], 'admin');
    }

    public function store(): void
    {
        if (!$this->checkCsrf()) {
            return;
        }

        $name = trim((string) ($_POST['name'] ?? ''));
        Session::set('_old_input', ['name' => $name]);

        if ($name === '' || mb_strlen($name) > 50) {
            Session::flash('error', 'Le nom est obligatoire (max 50 caractères).');
            $this->redirect('/admin/categories/create');
        }

        try {
            $categoryModel = new Category($this->config);
            $categoryModel->create($name);
            Session::forget('_old_input');
            Session::flash('success', 'Catégorie ajoutée.');
        } catch (Throwable $exception) {
            Session::flash('error', 'Impossible de créer la catégorie (nom déjà existant ?).');
        }

        $this->redirect('/admin/categories');
    }

    public function edit(string $id): void
    {
        if (!ctype_digit($id)) {
            Session::flash('error', 'Identifiant invalide.');
            $this->redirect('/admin/categories');
        }

        $categoryModel = new Category($this->config);
        $category = $categoryModel->findById((int) $id);

        if (!$category) {
            Session::flash('error', 'Catégorie introuvable.');
            $this->redirect('/admin/categories');
        }

        $this->render('admin/categories/edit', [
            'pageTitle' => 'Modifier catégorie',
            'category' => $category,
            'csrfToken' => Session::csrfToken(),
        ], 'admin');
    }

    public function update(string $id): void
    {
        if (!ctype_digit($id) || !$this->checkCsrf()) {
            Session::flash('error', 'Requête invalide.');
            $this->redirect('/admin/categories');
        }

        $name = trim((string) ($_POST['name'] ?? ''));

        if ($name === '' || mb_strlen($name) > 50) {
            Session::flash('error', 'Le nom est obligatoire (max 50 caractères).');
            $this->redirect('/admin/categories/' . $id . '/edit');
        }

        try {
            $categoryModel = new Category($this->config);
            $categoryModel->update((int) $id, $name);
            Session::flash('success', 'Catégorie mise à jour.');
        } catch (Throwable $exception) {
            Session::flash('error', 'Mise à jour impossible (nom déjà existant ?).');
        }

        $this->redirect('/admin/categories');
    }

    public function delete(string $id): void
    {
        if (!ctype_digit($id) || !$this->checkCsrf()) {
            Session::flash('error', 'Requête invalide.');
            $this->redirect('/admin/categories');
        }

        $categoryModel = new Category($this->config);
        $categoryId = (int) $id;

        if ($categoryModel->hasProjects($categoryId)) {
            Session::flash('error', 'Suppression impossible : cette catégorie contient des projets.');
            $this->redirect('/admin/categories');
        }

        try {
            $categoryModel->delete($categoryId);
            Session::flash('success', 'Catégorie supprimée.');
        } catch (Throwable $exception) {
            Session::flash('error', 'Suppression impossible.');
        }

        $this->redirect('/admin/categories');
    }

    private function checkCsrf(): bool
    {
        $token = $_POST['_csrf'] ?? null;

        if (!Session::verifyCsrfToken(is_string($token) ? $token : null)) {
            Session::flash('error', 'Token CSRF invalide.');
            return false;
        }

        return true;
    }
}

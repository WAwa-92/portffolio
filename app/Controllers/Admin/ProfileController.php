<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Models\User;
use Throwable;

class ProfileController extends Controller
{
    public function edit(): void
    {
        $userId = Auth::id();

        if ($userId === null) {
            Session::flash('error', 'Utilisateur non connecté.');
            $this->redirect('/login');
        }

        $userModel = new User($this->config);
        $user = $userModel->findById($userId);

        if (!$user) {
            Session::flash('error', 'Profil introuvable.');
            $this->redirect('/admin');
        }

        $this->render('admin/profile/edit', [
            'pageTitle' => 'Mon profil',
            'user' => $user,
            'csrfToken' => Session::csrfToken(),
        ], 'admin');
    }

    public function update(): void
    {
        $token = $_POST['_csrf'] ?? null;

        if (!Session::verifyCsrfToken(is_string($token) ? $token : null)) {
            Session::flash('error', 'Token CSRF invalide.');
            $this->redirect('/admin/profile');
        }

        $userId = Auth::id();

        if ($userId === null) {
            Session::flash('error', 'Utilisateur non connecté.');
            $this->redirect('/login');
        }

        $name = trim((string) ($_POST['name'] ?? ''));
        $githubUrl = trim((string) ($_POST['github_url'] ?? ''));
        $description = trim((string) ($_POST['description'] ?? ''));

        if ($name === '' || mb_strlen($name) > 50) {
            Session::flash('error', 'Nom obligatoire (max 50 caractères).');
            $this->redirect('/admin/profile');
        }

        if ($githubUrl !== '' && filter_var($githubUrl, FILTER_VALIDATE_URL) === false) {
            Session::flash('error', 'URL GitHub invalide.');
            $this->redirect('/admin/profile');
        }

        try {
            $userModel = new User($this->config);
            $userModel->updateProfile($userId, $name, $githubUrl, $description);
            Session::flash('success', 'Profil mis à jour.');
        } catch (Throwable $exception) {
            Session::flash('error', 'Mise à jour impossible.');
        }

        $this->redirect('/admin/profile');
    }
}

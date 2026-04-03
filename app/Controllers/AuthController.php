<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        if (Auth::check()) {
            $this->redirect('/admin');
        }

        $this->render('auth/login', [
            'pageTitle' => 'Connexion',
            'csrfToken' => Session::csrfToken(),
        ]);
    }

    public function login(): void
    {
        $token = $_POST['_csrf'] ?? null;

        if (!Session::verifyCsrfToken(is_string($token) ? $token : null)) {
            Session::flash('error', 'Token CSRF invalide.');
            $this->redirect('/login');
        }

        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            Session::flash('error', 'Email et mot de passe requis.');
            $this->redirect('/login');
        }

        $userModel = new User($this->config);
        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, (string) $user['password'])) {
            Session::flash('error', 'Identifiants invalides.');
            $this->redirect('/login');
        }

        Auth::login((int) $user['id']);
        Session::flash('success', 'Connexion réussie.');
        $this->redirect('/admin');
    }

    public function logout(): void
    {
        Auth::logout();
        Session::flash('success', 'Déconnexion réussie.');
        $this->redirect('/login');
    }
}

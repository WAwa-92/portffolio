<?php

declare(strict_types=1);

namespace App\Core;

final class Auth
{
    public static function check(): bool
    {
        return Session::get('auth_user_id') !== null;
    }

    public static function id(): ?int
    {
        $id = Session::get('auth_user_id');
        return is_int($id) ? $id : null;
    }

    public static function login(int $userId): void
    {
        session_regenerate_id(true);
        Session::set('auth_user_id', $userId);
    }

    public static function logout(): void
    {
        Session::forget('auth_user_id');
        session_regenerate_id(true);
    }
}

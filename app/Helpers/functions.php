<?php

declare(strict_types=1);

use App\Core\Session;

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function rich(?string $value): string
{
    $allowedTags = '<p><br><strong><em><ul><ol><li><a>';
    $clean = strip_tags((string) $value, $allowedTags);

    return str_ireplace('javascript:', '', $clean);
}

function old(string $key, string $default = ''): string
{
    $oldInput = Session::get('_old_input', []);
    if (!is_array($oldInput)) {
        return e($default);
    }

    return e((string) ($oldInput[$key] ?? $default));
}

<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findFirst(): ?array
    {
        $stmt = $this->pdo->query('SELECT * FROM users ORDER BY id ASC LIMIT 1');
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function getSkills(int $userId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM skills WHERE user_id = :user_id ORDER BY id ASC');
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll();
    }

    public function getProjects(int $userId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM projects WHERE user_id = :user_id ORDER BY created_at DESC');
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll();
    }

    public function updateProfile(int $id, string $name, string $githubUrl, string $description): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE users SET name = :name, github_url = :github_url, description = :description WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'github_url' => $githubUrl,
            'description' => $description,
        ]);
    }
}

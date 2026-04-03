<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Category extends Model
{
    public function all(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM categories ORDER BY name ASC');
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $category = $stmt->fetch();

        return $category ?: null;
    }

    public function getProjects(int $categoryId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM projects WHERE category_id = :category_id ORDER BY created_at DESC');
        $stmt->execute(['category_id' => $categoryId]);

        return $stmt->fetchAll();
    }
}

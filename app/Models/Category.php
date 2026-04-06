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

    public function create(string $name): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO categories (name) VALUES (:name)');
        return $stmt->execute(['name' => $name]);
    }

    public function update(int $id, string $name): bool
    {
        $stmt = $this->pdo->prepare('UPDATE categories SET name = :name WHERE id = :id');
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM categories WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function hasProjects(int $id): bool
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM projects WHERE category_id = :id');
        $stmt->execute(['id' => $id]);

        return (int) $stmt->fetchColumn() > 0;
    }
}

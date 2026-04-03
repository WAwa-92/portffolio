<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Project extends Model
{
    public function allWithCategory(): array
    {
        $sql = 'SELECT p.*, c.name AS category_name
                FROM projects p
                JOIN categories c ON c.id = p.category_id
                ORDER BY p.created_at DESC';

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $sql = 'SELECT p.*, c.name AS category_name
                FROM projects p
                JOIN categories c ON c.id = p.category_id
                WHERE p.id = :id
                LIMIT 1';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $project = $stmt->fetch();

        return $project ?: null;
    }

    public function getCategory(int $projectId): ?array
    {
        $stmt = $this->pdo->prepare('SELECT c.* FROM categories c JOIN projects p ON p.category_id = c.id WHERE p.id = :id LIMIT 1');
        $stmt->execute(['id' => $projectId]);
        $category = $stmt->fetch();

        return $category ?: null;
    }

    public function getTags(int $projectId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tags WHERE project_id = :project_id ORDER BY name ASC');
        $stmt->execute(['project_id' => $projectId]);

        return $stmt->fetchAll();
    }

    public function getImages(int $projectId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM images WHERE project_id = :project_id ORDER BY id ASC');
        $stmt->execute(['project_id' => $projectId]);

        return $stmt->fetchAll();
    }
}

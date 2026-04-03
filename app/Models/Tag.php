<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Tag extends Model
{
    public function allByProject(int $projectId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tags WHERE project_id = :project_id ORDER BY name ASC');
        $stmt->execute(['project_id' => $projectId]);

        return $stmt->fetchAll();
    }

    public function getProject(int $tagId): ?array
    {
        $stmt = $this->pdo->prepare('SELECT p.* FROM projects p JOIN tags t ON t.project_id = p.id WHERE t.id = :id LIMIT 1');
        $stmt->execute(['id' => $tagId]);
        $project = $stmt->fetch();

        return $project ?: null;
    }
}

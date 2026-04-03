<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Image extends Model
{
    public function allByProject(int $projectId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM images WHERE project_id = :project_id ORDER BY id ASC');
        $stmt->execute(['project_id' => $projectId]);

        return $stmt->fetchAll();
    }

    public function getProject(int $imageId): ?array
    {
        $stmt = $this->pdo->prepare('SELECT p.* FROM projects p JOIN images i ON i.project_id = p.id WHERE i.id = :id LIMIT 1');
        $stmt->execute(['id' => $imageId]);
        $project = $stmt->fetch();

        return $project ?: null;
    }
}

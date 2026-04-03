<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Skill extends Model
{
    public function allByUser(int $userId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM skills WHERE user_id = :user_id ORDER BY level DESC');
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll();
    }
}

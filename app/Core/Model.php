<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

abstract class Model
{
    protected PDO $pdo;

    public function __construct(protected array $config)
    {
        $this->pdo = Database::getConnection($this->config['db']);
    }
}

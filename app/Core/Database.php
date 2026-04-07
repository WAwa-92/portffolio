<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

final class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(array $dbConfig): PDO
    {
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        $dsn = 'mysql:host=' . $dbConfig['host'];
        $dsn .= ';port=' . $dbConfig['port'];
        $dsn .= ';dbname=' . $dbConfig['dbname'];
        $dsn .= ';charset=' . $dbConfig['charset'];

        try {
            self::$pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $exception) {
            http_response_code(500);
            exit('Erreur de connexion à la base de données.');
        }

        return self::$pdo;
    }
}

<?php
declare(strict_types=1);

/**
 * Simple PDO Database singleton.
 *
 * Reads connection details from environment variables if present:
 *  - DB_HOST (default 127.0.0.1)
 *  - DB_NAME (default refuge)
 *  - DB_USER (default root)
 *  - DB_PASS (default empty)
 */
class Database
{
    private static ?\PDO $instance = null;

    public static function getInstance(): \PDO
    {
        if (self::$instance === null) {
            $host = getenv('DB_HOST') ?: '127.0.0.1';
            $dbname = getenv('DB_NAME') ?: 'refuge';
            $user = getenv('DB_USER') ?: 'root';
            $pass = getenv('DB_PASS') ?: '';

            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $host, $dbname);

            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$instance = new \PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                throw new \RuntimeException('Database connection error: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }

    private function __construct()
    {
        // prevent instantiation
    }

    private function __clone()
    {
        // prevent cloning
    }

    private function __wakeup()
    {
        // prevent unserialize
    }
}

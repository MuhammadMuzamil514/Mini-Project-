<?php


namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private string $host = 'localhost';
    private string $db_name = 'posts';
    private string $username = 'root';
    private string $password = '';

    public ?PDO $conn = null;

    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            $this->conn = null;
            error_log('Database connection failed: ' . $e->getMessage());
        }
    }

    public function fetchdata(string $query, array $params = []): array
    {
        if (!$this->conn) {
            return [];
        }

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log('fetchdata error: ' . $e->getMessage());
            return [];
        }
    }

    public function fetchsingle(string $query, array $params = []): ?array
    {
        if (!$this->conn) {
            return null;
        }

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $row = $stmt->fetch();
            return $row ?: null;
        } catch (PDOException $e) {
            error_log('fetchsingle error: ' . $e->getMessage());
            return null;
        }
    }

    public function execute(string $query, array $params = []): bool
    {
        if (!$this->conn) {
            return false;
        }

        try {
            $stmt = $this->conn->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log('execute error: ' . $e->getMessage());
            return false;
        }
    }

    public function lastInsertId(): string
    {
        return $this->conn ? $this->conn->lastInsertId() : '0';
    }
}
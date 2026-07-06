<?php


namespace App\Models;

use App\Config\Database;

class Post
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all(): array
    {
        return $this->db->fetchdata(
            "SELECT id, title, content, user_id, created_at
             FROM posts
             ORDER BY id DESC"
        );
    }

    public function byUser(int $userId): array
    {
        return $this->db->fetchdata(
            "SELECT id, title, content, user_id, created_at
             FROM posts
             WHERE user_id = :user_id
             ORDER BY id DESC",
            ['user_id' => $userId]
        );
    }

    public function create(string $title, string $content, int $userId): bool
    {
        return $this->db->execute(
            "INSERT INTO posts (title, content, user_id)
             VALUES (:title, :content, :user_id)",
            [
                'title' => $title,
                'content' => $content,
                'user_id' => $userId,
            ]
        );
    }
}
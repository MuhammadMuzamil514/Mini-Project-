<?php

namespace App\Controllers;

use App\Models\Post;

class Dashboardcontroller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $postModel = new Post();
        $userId = $_SESSION['user']['id'] ?? $_SESSION['user_id'] ?? null;
        $posts = $userId ? $postModel->byUser((int)$userId) : $postModel->all();

        \view('Dashboard', ['user_posts' => $posts]);
    }

    public function store()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $userId = $_SESSION['user']['id'] ?? $_SESSION['user_id'] ?? null;

        if ($title === '' || $content === '' || !$userId) {
            \redirect('/dashboard?error=Invalid+data');
        }

        $postModel = new Post();
        $ok = $postModel->create($title, $content, (int)$userId);

        \redirect('/dashboard' . ($ok ? '?success=Saved' : '?error=Save+failed'));
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();
        \redirect('/login');
    }
}
<?php

namespace App\Controllers;

use App\Models\user;

class logincontroller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        \view('login');
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            \redirect('/login');
        }

        $user = new user();
        $user->email = trim($_POST['email'] ?? '');
        $user->password = $_POST['password'] ?? '';

        if ($user->login()) {
            $_SESSION['user_id'] = $user->Id ?? $user->id ?? null;
            $_SESSION['user_name'] = $user->name ?? '';
            $_SESSION['user'] = [
                'id' => $user->Id ?? $user->id ?? null,
                'name' => $user->name ?? '',
            ];

            \redirect('/dashboard');
        }

        \redirect('/login?error=Invalid+credentials');
    }
}
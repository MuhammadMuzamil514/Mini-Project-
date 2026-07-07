<?php
namespace App\Controllers;

use App\Models\user;

class Registercontroller{
    public function index(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        \view('register');
    }

    public function store()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            \redirect('/register');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            $_SESSION['register_error'] = 'Please fill in all fields.';
            \redirect('/register');
        }

        $user = new user();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        if ($user->register()) {
            $_SESSION['register_success'] = 'User registered successfully.';
            \redirect('/register');
        }

        $_SESSION['register_error'] = 'Error registering user.';
        \redirect('/register');
    }
}
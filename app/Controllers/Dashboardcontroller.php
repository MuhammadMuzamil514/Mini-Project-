<?php
namespace App\Controllers;

class Dashboardcontroller{
    public function index(){

    $posts= [
        ['id'=>1,'title'=>'Post 1','content'=>'Content of post 1'],
        ['id'=>2,'title'=>'Post 2','content'=>'Content of post 2'],
        ['id'=>3,'title'=>'Post 3','content'=>'Content of post 3'],
    ];
        view('Dashboard', ['posts' => $posts]);
        
    }

    public function logout(){
$_SESSION = [];

if (ini_get('session.use_cookies')) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
		$params['path'], $params['domain'],
		$params['secure'], $params['httponly']
	);
}
session_destroy();
header('Location: /login');
exit();

    }
}
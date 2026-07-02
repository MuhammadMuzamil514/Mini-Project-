<?php
namespace App\Controllers;
use App\Models\user;
class logincontroller{
    public function index(){

        $user=new user();
       $data = $user->fetchData("SELECT * FROM users");

        require( 'pages/login.php');
        
    }

    public function login(){

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user= new user();
   $user->email = $_POST['email'];
   $user->password = $_POST['password'];

if ($user->login()) {
$_SESSION['user_id'] = $user->Id;
$_SESSION['user_name'] = $user->name;

 require( 'pages/Dashboard.php');
// header("Location: Dashboard.php");
exit();
} else {
  echo "Error login user.";
}
}
    }
}
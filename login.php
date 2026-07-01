<?php 
session_start();
require_once __DIR__ . '/app/user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user= new user();
   $user->email = $_POST['email'];
   $user->password = $_POST['password'];

if ($user->login()) {
$_SESSION['user_id'] = $user->Id;
$_SESSION['user_name'] = $user->name;


header("Location: Dashboard.php");
exit();
} else {
  echo "Error login user.";
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Auth System </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6 pt-4">


            <h2>Login form</h2>
            <form action="login.php" method ="post">
                <div class="form-group">
                    <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="register.php" class="btn btn-dark">Register</a>
  </form>
</div>

</div>
</div>
</body>
</html>

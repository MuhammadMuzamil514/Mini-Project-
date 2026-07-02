<?php
use App\Services\Route;

Route ::add('/', 'homecontroller', 'index','Get');
Route ::add('dashboard', 'Dashboardcontroller', 'index','Get');
Route ::add('logout', 'Dashboardcontroller', 'logout','Get');
Route ::add('login', 'logincontroller', 'index','Get');
Route ::add('register', 'Registercontroller', 'index','Get');
Route ::add('submit-login', 'logincontroller', 'login','Post');
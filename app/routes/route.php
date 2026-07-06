<?php


use App\Services\Route;

Route::add('/', 'homecontroller', 'index', 'GET');
Route::add('dashboard', 'Dashboardcontroller', 'index', 'GET');
Route::add('dashboard/store', 'Dashboardcontroller', 'store', 'POST');
Route::add('logout', 'Dashboardcontroller', 'logout', 'GET');
Route::add('login', 'logincontroller', 'index', 'GET');
Route::add('register', 'Registercontroller', 'index', 'GET');
Route::add('register', 'Registercontroller', 'store', 'POST');
Route::add('submit-login', 'logincontroller', 'login', 'POST');
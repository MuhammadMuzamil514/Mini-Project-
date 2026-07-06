<?php

define('APP_ROOT', __DIR__);

require_once __DIR__ . '/app/helper.php';
require_once __DIR__ . '/vendor/autoload.php';

spl_autoload_register(function ($class) {
    $prefix = 'App\\';

    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $classpath = APP_ROOT . '/app/' . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

    if (file_exists($classpath)) {
        require_once $classpath;
    }
});

session_start();

use App\Services\Route;

require_once APP_ROOT . '/app/routes/route.php';
Route::handle();
<?php

define('APP_ROOT', __DIR__);

function view(string $template, array $data = []): void
{
    extract($data, EXTR_SKIP);

    $templateFile = APP_ROOT . '/pages/' . $template . '.php';

    if (!file_exists($templateFile)) {
        throw new RuntimeException('View not found: ' . $template);
    }

    require $templateFile;
}

require_once APP_ROOT . '/vendor/autoload.php';
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

}
);
session_start();

use App\Services\Route;
$route=new Route();


require_once APP_ROOT . '/app/routes/route.php';
$route->handle();
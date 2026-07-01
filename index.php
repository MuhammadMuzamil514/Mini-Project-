<?php

define('APP_ROOT', __DIR__);

echo APP_ROOT;

require_once APP_ROOT . '/vendor/autoload.php';
spl_autoload_register(function ($class) {
$classfile=str_replace ("\\",DIRECTORY_SEPARATOR,$class.'.php');

$classpath=APP_ROOT.'/App/'.$classfile.'';
if(file_exists($classpath)){
    require_once ($classpath);
}

}
);
session_start();
<?php

ob_start();
session_start();

$date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$datetime = $date->format('Y-m-d H:i:s');

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

include_once BASE_PATH . 'app/Globals.php';
if(env('DEBUG','false') == 'true'){
    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
    $whoops->register();
}

$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);

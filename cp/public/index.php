<?php

error_reporting(E_ALL ^ E_WARNING && E_NOTICE);

/*
|--------------------------------------------------------------------------
| Register the Autoloader, System and Kernel
|--------------------------------------------------------------------------
*/
include_once '../system.php';
include_once BASE_PATH.'vendor/autoload.php';
include_once BASE_PATH.'app/Kernel.php';

include_once BASE_PATH.'app/functions/autoload.php';

include_once BASE_PATH.'app/notifications/sendMail.php';

/*
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
*/

define('SYSTEM_END', round(microtime(true) - SYSTEM_START,4));

include_once BASE_PATH.'router/app.php';
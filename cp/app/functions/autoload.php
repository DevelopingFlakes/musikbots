<?php

include_once BASE_PATH.'app/controller/Controller.php';

foreach (glob('../app/functions/*.php') as $filename)
{
    if($filename != 'autoload.php'){
        include_once $filename;
    }
}

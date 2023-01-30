<?php

$currPage = 'front_Activate';
include 'app/controller/PageController.php';

$key = $_GET['key'];
if(isset($key) && !empty($key)){

    $SQLCheckKey = $db->prepare("SELECT COUNT(*) FROM `users` WHERE `verify_code` = :key");
    $SQLCheckKey->execute(array(':key' => $key));
    $countKey = $SQLCheckKey -> fetchColumn(0);
    if ($countKey == 1){
        $updateUser = $db->prepare("UPDATE `users` SET `state`=:state, `verify_code`=:newKey WHERE `verify_code` = :key");
        $updateUser->execute(array(":key" => $key, ":state" => 'active', ":newKey" => NULL));
        $_SESSION['success_msg'] = 'Account bestätigt! Du kannst dich nun einloggen';
        header('Location: '.$helper->url().'login');
        die();
    } else {
        $_SESSION['error_msg'] = 'Dein Account ist bereits bestätigt';
        header('Location: '.$helper->url().'login');
        die();
    }

} else {
    $_SESSION['error_msg'] = 'Bitte gebe einen gültigen Key an';
    header('Location: '.$helper->url().'login');
    die();
}

?>
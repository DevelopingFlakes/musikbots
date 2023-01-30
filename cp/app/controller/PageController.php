<?php

if($user->sessionExists($_COOKIE['session_token'])){

    /*
     * set static values
     */
    $username = $user->getDataBySession($_COOKIE['session_token'],'username');
    $mail = $user->getDataBySession($_COOKIE['session_token'],'email');
    $amount = $user->getDataBySession($_COOKIE['session_token'],'amount');
    $userid = $user->getDataBySession($_COOKIE['session_token'],'id');

    $user_addr = $user->getDataBySession($_COOKIE['session_token'],'user_addr');
    if(is_null($user_addr)){
        $SQL = $db->prepare("UPDATE `users` SET `user_addr` = :user_addr WHERE `id` = :id");
        $SQL->execute(array(":user_addr" => $user->getIP(), ":id" => $userid));
        $user_addr = $user->getIP();
    }
    if($user->getIP() != $user_addr){
        $_SESSION['info_msg'] = 'Session Expired';
        setcookie('session_token', null, time(), '/'); header('Location: '.$helper->url().'login');
        die();
    }

    if($user->getState($mail) == 'pending'){
        $_SESSION['info_msg'] = 'Bitte bestätige deinen Account';
        header('Location: '.env('URL').'logout');
        die();
    }

}

/*
 * logged in user check
 */
if(strpos($currPage,'_auth') !== false) {
    if($user->sessionExists($_COOKIE['session_token'])){
        die(header('Location: '.env('URL').'dashboard'));
    }
}

if (strpos($currPage,'back_') !== false || strpos($currPage,'team_') !== false) {

    /*
     * check if logged in
     */
    if(!$user->sessionExists($_COOKIE['session_token'])){
        die(header('Location: '.env('URL').'login'));
    }

    /*
     * check if user is on team page and is in team
     */
    if(strpos($currPage,'team_') !== false) {
        if(!$user->isInTeam($_COOKIE['session_token'])){
            die(header('Location: '.env('URL').'dashboard'));
        }
    }

    /*
     * check if user is on admin page and is admin
     */
    if(strpos($currPage,'_admin') !== false) {
        if(!$user->isAdmin($_COOKIE['session_token'])){
            die(header('Location: '.env('URL').'dashboard'));
        }
    }

}

$currPageName = explode('_',$currPage)[1];
if (strpos($currPage,'system_') !== false) {} else {
    include BASE_PATH.'resources/additional/head.php';
    include BASE_PATH . 'resources/additional/sidebar.php';
    include BASE_PATH . 'resources/additional/header.php';
    if ($user->sessionExists($_COOKIE['session_token'])) {
        echo '<div class="content">';
    } else {
        if (strpos($currPage,'_auth') !== false) {} else {
            echo '<div class="content">';
        }
    }

    include BASE_PATH.'app/notifications/sendAlert.php';
    include BASE_PATH.'app/notifications/sendSweetAlert.php';

    /*
     * manage cookies
     */
    if(isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg'])){
        echo sendError($_SESSION['error_msg']);
        $_SESSION['error_msg'] = '';
        unset($_SESSION['error_msg']);
    }

    if(isset($_SESSION['info_msg']) && !empty($_SESSION['info_msg'])){
        echo sendInfo($_SESSION['info_msg']);
        $_SESSION['info_msg'] = '';
        unset($_SESSION['info_msg']);
    }

    if(isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])){
        echo sendSuccess($_SESSION['success_msg']);
        $_SESSION['success_msg'] = '';
        unset($_SESSION['success_msg']);
    }

}
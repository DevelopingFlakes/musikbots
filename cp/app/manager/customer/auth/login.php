<?php
if(isset($_POST['login'])){
    $error = null;

    if(empty($_POST['email'])){
        $error = 'Bitte gib eine E-Mail an';
    }

    if(empty($_POST['password'])){
        $error = 'Bitte gib ein Passwort an';
    }

    if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){
        $error = 'Bitte gib eine gültige E-Mail an';
    }

    if(!$user->verifyLogin($_POST['email'], $_POST['password'])){
        $error = 'Das angegebene Passwort stimmt nicht';
    }

    if($helper->getSetting('login') == 0){
        if($user->getDataByEmail($_POST['email'],'role') == 'support' || $user->getDataByEmail($_POST['email'],'role') == 'admin'){
            //nothing atm
        } else {
            $error = 'Der Login ist derzeit deaktiviert';
        }
    }

    if($user->getState($_POST['email']) == 'pending'){
        $error = 'Bitte bestätige erst deine E-Mail';
    }

    if($user->getState($_POST['email']) == 'banned'){
        $error = 'Dein Account ist gesperrt, wende dich an den E-Mail Support.';
    }

    if(empty($error)){

        $SQL = $db->prepare("UPDATE `users` SET `user_addr` = :user_addr WHERE `email` = :email");
        $SQL->execute(array(":user_addr" => $user->getIP(), ":email" => $_POST['email']));

        $sessionId = $user->generateSessionToken($_POST['email']);
        if(isset($_POST['stayLogged'])){
            setcookie('session_token', $sessionId,time()+'864000','/');
        } else {
            setcookie('session_token', $sessionId,time()+'86400','/');
        }
        $_SESSION['success_msg'] = 'Login Erfolgreich, Willkommen!';
        header('Location: '.$helper->url().'dashboard');

    } else {
        echo sendError($error);
    }
}
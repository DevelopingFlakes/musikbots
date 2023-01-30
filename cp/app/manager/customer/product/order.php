<?php

if(isset($_POST['order'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    if(empty($_POST['planName'])){
        $error = 'Es konnte kein Produkt Paket gefunden werden';
    }

    if($product->getPrice($_POST['planName']) == false){
        $error = 'Es konnte kein Produkt Paket mit diesem Namen gefunden werden';
    }

    $runtime = 30;
    $db_price = $product->getPrice($_POST['planName']);
    $price = $db_price * $validate->getIntervalFactor($runtime);
    $price = number_format($price,2);

    if($amount < $price){
        $error = 'Du hast leider nicht genügend Guthaben';
        $_SESSION['error_msg'] = 'Du hast leider nicht genügend Guthaben';
        header('Location: '.env('URL').'accounting/charge');
        die();
    }

    if($price == 0){
        $error = 'Ungültige Anfrage bitte versuche es erneut (1001)';
    }

    if(empty($error)){

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $runtime . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

        $SQL = $db->prepare("INSERT INTO `customer_products`(`product_name`, `product_id`, `user_id`, `desc`, `state`, `expire_at`, `price`) VALUES (?,?,?,?,?,?,?)");
        $SQL->execute(array($product->getDataById($_POST['planName'])['name'], $_POST['planName'], $userid, $product->getDataById($_POST['planName'])['desc'], 'pending', $expire_at, $price));

        $user->removeMoney($price, $userid);
        $user->addTransaction($userid,'-'.$price,$product->getDataById($_POST['planName'])['name'].' Bestellung');

        $_SESSION['success_msg'] = 'Vielen Dank! Dein Produkt wirdin kürze freigeschaltet';
        header('Location: '.env('URL').'manage/product');

    } else {
        $_SESSION['error_msg'] = $error;
        header('Location: '.env('URL').'order/product');
    }

}
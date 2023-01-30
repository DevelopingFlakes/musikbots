<?php

if(isset($_POST['startPayment'])){

    $error = null;

    if(empty($_POST['amount'])){
        $error = 'Bitte gebe einen Betrag ein';
    }

    if(!is_numeric($_POST['amount'])){
        $error = 'Bitte gebe einen Betrag ein (Zahl)';
    }

    $payment_method = $_POST['payment_method'];
    if(empty($payment_method)){
        $error = 'Bitte wähle eine Zahlungsmethode';
    }

    if($_POST['amount'] < 1){
        $error = 'Bitte gebe einen Betrag über 1.00€ ein';
    }

    if($_POST['amount'] > 500){
        $error = 'Bitte gebe einen Betrag unter 500.00€ ein';
    }

    if(empty($error)){

        if($payment_method == 'paypal'){

            require BASE_PATH.'app/manager/customer/payment/functions.php';

            $paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

            $itemName = 'Guthabenaufladung | kd'.$userid;
            $itemAmount = $_POST['amount'];

            $data = [];

            $data['business'] = $paypalConfig['email'];

            $data['return'] = stripslashes($paypalConfig['return_url']);
            $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
            $data['notify_url'] = stripslashes($paypalConfig['notify_url']);

            $data['item_name'] = $itemName;
            $data['amount'] = $itemAmount;
            $data['currency_code'] = 'EUR';
            $data['custom'] = $_COOKIE['session_token'];

            $queryString = http_build_query($data);
            header('location:' . $paypalUrl . '?cmd=_xclick&' . $queryString);
            die();

        } else {
            echo sendError('Ungültige Zahlungsmethode');
        }

    } else {
        echo sendError($error);
    }

}
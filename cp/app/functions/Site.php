<?php

$site = new Site();
$db = $helper->db();

class Site extends Controller
{

    public function currentUrl()
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        return $actual_link;
    }

    public function addTransaction($user_id, $gateway, $state, $amount, $desc, $tid){
        $SQL = self::db()->prepare("INSERT INTO `transactions`(`user_id`, `gateway`, `state`, `amount`, `desc`, `tid`) VALUES (:user_id,:gateway,:state,:amount,:desc,:tid)");
        $SQL->execute(array(':user_id' => $user_id, ':gateway' => $gateway, ':state' => $state, ':amount' => $amount, ':desc' => $desc, ':tid' => $tid));
    }

    public function getDiffInDays($dateTime){
        $datetime1 = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $datetime2 = new DateTime($dateTime, new DateTimeZone('Europe/Berlin'));
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%a');
    }

    public function generateCSRF($length = 28)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
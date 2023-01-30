<?php

$helper = new Helper();

class helper extends Controller
{

    public function protect($string)
    {
        $protection = htmlspecialchars(trim($string), ENT_QUOTES);
        return $protection;
    }

    public function xssFix($string){

        $string = $this->protect($string);

        $string = str_replace('<','', $string);
        $string = str_replace('>','', $string);
        $string = str_replace('´','', $string);
        $string = str_replace('[','(', $string);
        $string = str_replace(']',')', $string);
        //$string = str_replace('_','', $string);
        $string = str_replace("'",'', $string);

        return $string;
    }

    public function nl2br2($string)
    {
        $string = $this->xssFix($string);
        $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
        return $string;
    }

    public function formatDate($date)
    {
        $date = new DateTime($date, new DateTimeZone('Europe/Berlin'));
        return $date->format('d.m.Y H:i:s');
    }

    public function formatDateToTimestamp($date)
    {
        $date = new DateTime($date, new DateTimeZone('Europe/Berlin'));
        return $date->getTimestamp();
    }

    public function formatDateWithoutTime($date)
    {
        $date = new DateTime($date, new DateTimeZone('Europe/Berlin'));
        return $date->format('d.m.Y');
    }

    public function generateRandomString($length = 10, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getSetting($data)
    {
        $SQL = self::db()->prepare("SELECT * FROM `settings`");
        $SQL->execute();
        $response = $SQL->fetch(PDO::FETCH_ASSOC);
        return $response[$data];
    }

    public function human_filesize($bytes, $dec = 2)
    {
        $size   = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$dec}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    public function isa_convert_bytes_to_specified($bytes, $to, $decimal_places = 1) {
        $formulas = array(
            'K' => number_format($bytes / 1024, $decimal_places),
            'M' => number_format($bytes / 1048576, $decimal_places),
            'G' => number_format($bytes / 1073741824, $decimal_places)
        );
        return isset($formulas[$to]) ? $formulas[$to] : 0;
    }

    public function getGlobalIncomeAtDate($first, $last)
    {
        $SQL = self::db()->prepare("SELECT SUM(`amount`) AS `income_val` FROM `transactions` WHERE `state` = 'success' AND `created_at` BETWEEN ? AND ?");
        $SQL->execute(array($first, $last));
        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        if(empty($response['income_val'])){
            $income_val = 0;
        } else {
            $income_val = $response['income_val'];
        }

        return $income_val;
    }

}
?>
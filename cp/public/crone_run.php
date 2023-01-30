<?php
$currPage = 'system_runtime queue';
include BASE_PATH.'app/controller/PageController.php';

//Time now
$date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$dateTimeNow = $date->format('Y-m-d H:i:s');

//Time minus 7 days
$datePlus = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$datePlus->modify('-2 day');
$dateTimeMinus7Days = $datePlus->format('Y-m-d H:i:s');

$key = $helper->protect($_GET['key']);
if($key == env('CRONE_KEY')){

    /* ======================================================================================================================================== */


    $productSuspendedDB = $db->prepare("SELECT * FROM `attacks` WHERE `expire_at` < :dateTimeNow AND `state` = 'pending'");
    $productSuspendedDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($productSuspendedDB->rowCount() != 0) {
        while ($row = $productSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `attacks` SET `state` = 'success' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

            echo 'Angriff beendet #'.$row['id'];

        }
    }

    /* ======================================================================================================================================== */
    die('nothing todo');

} else {
    include BASE_PATH.'resources/sites/404.php';
}
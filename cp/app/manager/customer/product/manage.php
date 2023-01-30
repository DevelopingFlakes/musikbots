<?php

$id = $helper->protect($_GET['id']);

$SQLGetServerInfos = $db->prepare("SELECT * FROM `customer_products` WHERE `id` = :id");
$SQLGetServerInfos -> execute(array(":id" => $id));
$serverInfos = $SQLGetServerInfos -> fetch(PDO::FETCH_ASSOC);

if($serverInfos['state'] == 'pending'){
    die(header('Location: '.$helper->url().'manage/product'));
}

if(!($serverInfos['deleted_at'] == NULL)){
    header('Location: '.$helper->url().'order/product');
}

if($serverInfos['state'] == 'suspended'){
    $suspended = true;
} else {
    $suspended = false;
}

if($userid != $serverInfos['user_id']){
    die(header('Location: '.$helper->url().'manage/product'));
}
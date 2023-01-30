<?php
$SQLGETSERVER = $db->prepare("SELECT * FROM `servers` WHERE `id` = :serverid");
$SQLGETSERVER->execute(array(":serverid" => $serverid));
if ($SQLGETSERVER->rowCount() != 0) {
while ($serv = $SQLGETSERVER -> fetch(PDO::FETCH_ASSOC)){

include BASE_PATH."app/sinusbot/autoload.php";
$sinusbot = new SinusBot\API($serv['url']);
$sinusbot->login($serv['username'], $serv['password']);

} }

$SQLGETALLBOTS = $db->prepare("SELECT * FROM `bots` WHERE `server_id` = :serverid");
$SQLGETALLBOTS->execute(array(":serverid" => $serverid));
if ($SQLGETALLBOTS->rowCount() != 0) {
while ($bot = $SQLGETALLBOTS -> fetch(PDO::FETCH_ASSOC)){ 

$instance = $sinusbot->getInstanceByUUID($bot['ext_id']);
$instance->kill();


}}
?>

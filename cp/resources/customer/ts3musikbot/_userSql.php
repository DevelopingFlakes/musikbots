<?php
$SQLMAINGETBOT = $db->prepare("SELECT * FROM `bots` WHERE `id` = :siteid AND `owner_id` = :userid");
$SQLMAINGETBOT->execute(array(":siteid" => $siteid, ":userid" => $userid));
if ($SQLMAINGETBOT->rowCount() != 0) {
while ($bot = $SQLMAINGETBOT -> fetch(PDO::FETCH_ASSOC)){ ?>
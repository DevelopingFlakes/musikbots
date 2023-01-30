<?php
//=======================================================================================================
// WebHoook Start
//=======================================================================================================

$webhookurl = "https://discord.com/api/webhooks/894206293001240626/L5c7VKs48hlfd3t43O4_z_GDHmSTIOcDep6ACZkQnerr-JYMY9n8agTdaj_Hq6vHc6wn";
$date = new DateTime(null, new DateTimeZone('Europe/Berlin'));

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([
	
    "content" => "<@&894000109224882269> $webhook_content",
    
    // Username
    "username" => "",

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );

//=======================================================================================================
// WebHoook End
//=======================================================================================================
?>
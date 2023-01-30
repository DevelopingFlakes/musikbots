<?php
// Webhook Start

$url = "https://discord.com/api/webhooks/971508838400401468/G5rwQMGEs179I-S1ulJn4R-QOuHX31OD80QNRb_lmvimAddSf2AezleHrG8f2IUeBLJZ";

$hookObject = json_encode([
    /*
     * The general "message" shown above your embeds
     */
    "content" => "Ein Angriff wurde gestartet",
    /*
     * The username shown in the message
     */
    "username" => "Attack",
    /*
     * The image location for the senders image
     */
    "avatar_url" => "https://media.discordapp.net/attachments/866756750589558816/901608625041182820/image-removebg-preview_3.png",
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            // Set the title for your embed
            "title" => "Informationen",

            // The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            // A description for your embed
            "description" => "",

            // The URL of where your title will be a link to
            "url" => "",

            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => "",

            // The integer color to be used on the left side of the embed
            "color" => hexdec( "FFFFFF" ),

            // Footer object
            "footer" => [
                "text" => "",
                "icon_url" => ""
            ],

            // Image object
            "image" => [
                "url" => ""
            ],

            // Thumbnail object
            "thumbnail" => [
                "url" => ""
            ],

            // Author object
            "author" => [
                "name" => "IDosNow",
                "url" => "https://idosnow.eu/"
            ],

            // Field array of objects
            "fields" => [

                [
                    "name" => "IPv4",
                    "value" => $_POST['ipv4'].":".$_POST['port'],
                    "inline" => false
                ],
                [
                    "name" => "Stärke",
                    "value" => $_POST['power'] ." MBIT/s",
                    "inline" => false
                ],
                [
                    "name" => "Layer",
                    "value" => $_POST['layer'] ."/7",
                    "inline" => false
                ],
                [
                    "name" => "Dauer",
                    "value" => $_POST['duration'] ." Minuten",
                    "inline" => false
                ],
                [
                    "name" => "Status",
                    "value" => $_POST['state'],
                    "inline" => false
                ],
                [
                    "name" => "Server",
                    "value" => $_POST['ddosserver'],
                    "inline" => false
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
curl_close( $ch );

// Webhook Ende
?>
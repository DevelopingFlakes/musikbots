<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($user_email, $user_name, $mailContent, $mailSubject, $emailAltBody = null){

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '52a4239a903ea1';
        $mail->Password = 'd8bd486f477623';
        $mail->CharSet = "UTF-8";
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Port = 587;

        $mail->setFrom('no-reply@example.com', 'Kundendienst');
        $mail->addAddress($user_email, $user_name);

        $mail->isHTML(true);
        $mail->Subject = $mailSubject;
        $mail->Body = $mailContent;
        $mail->AltBody = $emailAltBody;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    }

}
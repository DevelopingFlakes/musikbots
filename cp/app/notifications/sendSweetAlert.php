<?php
/*
 * Sweetalert 2
 */

function sendSweetError($message, $title = 'Fehler'){
    return '<script> Swal.fire( "'.$title.'", "'.$message.'", "error" ); </script>';
}

function sendSweetInfo($message, $title = 'Info'){
    return '<script> Swal.fire( "'.$title.'", "'.$message.'", "info"); </script>';
}

function sendSweetSuccess($message, $title = 'Erfolgreich'){
    return '<script> Swal.fire( "'.$title.'", "'.$message.'", "success"); </script>';
}
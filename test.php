<?php
$to = "uran.canhasi@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: wmelectricite.notification@gmail.com";

$success = mail($to,$subject,$txt,$headers);
if (!$success) {
    $errorMessage = error_get_last()['message'];
}


?>
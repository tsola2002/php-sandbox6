<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['send'])){
    // turn on phpmailer
    $mail = new PHPMailer(true);

    // configure smtp 
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'omatsolasobotie@gmail.com';
    $mail->Password = 'dwaywyxyuxfpfgvj';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    //EMAIL DETAILS
    $mail->setFrom('tsola2002@yahoo.co.uk');
    $mail->addAddress($_POST['email']);
    $mail->isHTML(true);

    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];

    $mail->send();

    echo "
        <script>
            alert('Sent Successfully');
            document.location.href = 'index.php';
        </script>
    ";
}

?>
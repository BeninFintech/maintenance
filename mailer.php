<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'aime.degbey@bftgroup.co';                     //SMTP username
    $mail->Password   = 'loecmuebkbtwrawk';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('aime.degbey@bftgroup.co', 'BFT FORMULAIRE DE CONTACT');
    $mail->addAddress('contact@bftgroup.co', 'BFT GROUP');     //Add a recipient
    $mail->addReplyTo($_POST['email'], htmlentities($_POST['name']));

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'object';
    $mail->Body    = '<b>Entreprise: '.htmlentities($_POST['company']).' </b> <br> '. htmlentities($_POST['message']);

    $mail->send();
    ?>
      <div class="alert alert-success">Message envoyé</div>
    <?php
} catch (Exception $e) {
    ?>
    <div class="alert alert-danger">Une erreur s'est produite</div>
    <?php
}

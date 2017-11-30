<?php
/**
 * Created by PhpStorm.
 * User: elmogch
 * Date: 27/11/17
 * Time: 10:01 PM
 */

// Pear Mail Library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/Exception.php";
require "PHPMailer/src/SMTP.php";
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    $request = $_REQUEST;
    //echo "request: <pre>" . print_r($request, TRUE) . "</pre>";
    //exit;
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'onoff.cantaloop.mx';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ducky@onoff.cantaloop.mx';                 // SMTP username
    $mail->Password = 't4ll3r0n0ff';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($request['email'], $request['fullname']);
    $mail->addAddress('ducky@onoff.cantaloop.mx', 'Contacto Ducky');     // Add a recipient
    //$mail->addCC('cc@example.com');
    $mail->addBCC($request['email']);

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $request['subject'];
    $mail->Body    = $request['message'];
    $mail->AltBody = strip_tags($request['message']);

    $mail->send();
    echo '<script>setTimeout("history.back(-1)", 3000);</script>';
    echo 'Mensaje enviado';
} catch (Exception $e) {
    echo 'El mensaje no pudo ser enviado.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
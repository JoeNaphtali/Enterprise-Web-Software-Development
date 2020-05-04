<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function sendmail($to, $subject, $message) {
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ewebdevteam3@gmail.com';                     // SMTP username
    $mail->Password   = 'Eweb@team3';                               // SMTP password
    $mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $address = $to;
    //Recipients
    $mail->setFrom('noreply@gmail.com', 'Ideas');
    $mail->addAddress($address);     // Add a recipient
    $mail->AddReplyTo("ewebdevteam3@gmail.com","Staff");

    $body = $message;

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    if(!$mail->Send()) {
        return 0;
    } else {
          return 1;
    }
}

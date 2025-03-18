<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php"; // Autoload PHPMailer classes

$mail = new PHPMailer(true); // Create a new PHPMailer instance

// Uncomment this to enable debugging (optional, for debugging purposes)
// $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output

$mail->isSMTP(); // Set the mailer to use SMTP
$mail->SMTPAuth = true; // Enable SMTP authentication

// SMTP server settings
$mail->Host = "smtp.gmail.com"; // Replace with the actual SMTP host (e.g., 'smtp.gmail.com' for Gmail)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use STARTTLS for encryption
$mail->Port = 587; // Port for STARTTLS
$mail->Username = ""; // Your email address (sender)
$mail->Password = ""; // Your email password or App Password (if 2FA enabled)

$mail->isHTML(true); // Set email format to HTML

// You can also set the sender, recipient, subject, and body as follows
//$mail->setFrom('from@example.com', 'Mailer');
//$mail->addAddress('recipient@example.com', 'Joe User'); // Add recipient
//$mail->Subject = 'Test Email';
//$mail->Body    = 'This is a <b>HTML</b> message body';
//$mail->AltBody = 'This is the plain-text version of the message';

// Return the configured PHPMailer object
return $mail;

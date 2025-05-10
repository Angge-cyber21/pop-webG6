<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$message = htmlspecialchars(trim($_POST['message']));

$mail = new PHPMailer(true);

try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pop.webG6@gmail.com'; // Your Gmail
    $mail->Password = 'kqcvyyyrdoemmjjs'; // Your Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email content
    $mail->setFrom('pop.webG6@gmail.com', 'PreOrder Pal');
    $mail->addAddress('pop.webG6@gmail.com'); // Receiver email

    $mail->isHTML(true);
    $mail->Subject = 'New Message from PreOrder Pal';
    $mail->Body    = "
        <strong>Name:</strong> $name<br>
        <strong>Email:</strong> $email<br><br>
        <strong>Message:</strong><br>$message
    ";

    $mail->send();

    // Success Alert
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
    <script>
        Swal.fire({
            title: 'Message Sent!',
            text: 'Thank you, " . addslashes($name) . "! We will get back to you.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'dashboard.php';
        });
    </script>
    </body>
    </html>";
} catch (Exception $e) {
    // Error Alert
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
    <script>
        Swal.fire({
            title: 'Oops!',
            text: 'Email could not be sent. Mailer Error: " . addslashes($mail->ErrorInfo) . "',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'dashboard.php';
        });
    </script>
    </body>
    </html>";
}
?>

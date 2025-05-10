<?php
// Include PHPMailer or any mail library you use here
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Use Composer autoload for PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $drink = $_POST["drink"];
    $size = $_POST["size"];
    $price = $_POST["price"];
    $payment_method = $_POST["payment_method"]; // Either "pay_at_counter" or "pay_online"

    // Prepare email content
    $order_summary = "Drink: $drink\nSize: $size\nPrice: ₱$price";

    // Send the email to the user
    $user_email = "user_email@example.com"; // Replace with the actual user email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com';
        $mail->Password = 'your_email_password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender's email
        $mail->setFrom('your_email@example.com', 'PreOrder Pal');
        // Recipient's email (user and admin)
        $mail->addAddress($user_email);
        $mail->addAddress('pop.webG6@gmail.com'); // Send to restaurant

        // Subject and body
        $mail->isHTML(true);
        $mail->Subject = 'Order Confirmation';
        $mail->Body = "<p>Thank you for your order! Here is the summary:</p><pre>$order_summary</pre>";

        $mail->send();
        echo 'Order confirmation email has been sent.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Redirect to payment if chosen to pay online
    if ($payment_method === "pay_online") {
        header("Location: payment.php");
        exit();
    } else {
        // Show order summary if paying at the counter (handled via SweetAlert2)
        echo '<script>window.location = "javascript:showOrderSummary()";</script>';
    }
}
?>

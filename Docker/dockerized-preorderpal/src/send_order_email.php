<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure this is correct and PHPMailer is installed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect POST values
    $name = $_POST["name"];
    $email = $_POST["email"];
    $restaurant = $_POST["restaurant"];
    $main = $_POST["main"];
    $main_size = $_POST["main_size"];
    $main_price = $_POST["main_price"];
    $drink = $_POST["drink"];
    $drink_price = $_POST["drink_price"];
    $dessert = $_POST["dessert"];
    $dessert_price = $_POST["dessert_price"];
    $total = $_POST["total"];
    $payment_method = $_POST["payment_method"];

    // Compose order summary for email
    $order_summary = "
        <h2>Order Receipt</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Restaurant:</strong> $restaurant</p>
        <p><strong>Main:</strong> $main ($main_size) - ₱$main_price.00</p>
        <p><strong>Drink:</strong> $drink - ₱$drink_price.00</p>
        <p><strong>Dessert:</strong> $dessert - ₱$dessert_price.00</p>
        <p><strong>Total:</strong> ₱$total.00</p>
    ";

    // Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pop.webG6@gmail.com';         // Your Gmail
        $mail->Password = 'kqcvyyyrdoemmjjs';           // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('yourgmail@gmail.com', 'PreOrder Pal');
        $mail->addAddress($email, $name);                // Customer
        $mail->addAddress('pop.webG6@gmail.com');        // Restaurant/Admin

        $mail->isHTML(true);
        $mail->Subject = 'Your PreOrder Pal Receipt';
        $mail->Body    = $order_summary;

        $mail->send();
        echo "<script>alert('Order placed and receipt sent!');</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Handle redirect based on payment method
    if ($payment_method === "pay_online") {
        header("Location: payment.php");
        exit();
    } else {
        // Show order summary if paying at the counter
        echo '<script>window.location = "javascript:showOrderSummary()";</script>';
    }
}
?>

<?php
session_start();

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Error reporting (for debugging)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if platter is selected
if (!isset($_SESSION['selected_platter']) || !isset($_SESSION['platter_details'])) {
    header('Location: index.php');
    exit();
}

$selectedPlatter = $_SESSION['selected_platter'];
$platterDetails = $_SESSION['platter_details'];
$price = $platterDetails['price'];
$_SESSION['total'] = $price;
$items = $platterDetails['items'];
$title = $platterDetails['title'];

// Retrieve reservation details from session
$reservations = isset($_SESSION['reservation']) ? $_SESSION['reservation'] : [];

// Email sending
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['name'];
    $email = $_POST['email'];

    // Build receipt
    $receipt = "
        <h2>PreOrder Pal - Platter Receipt</h2>
        <p><strong>Name:</strong> $customer_name</p>
        <p><strong>Selected Platter:</strong> $title</p>
        <ul>";

    foreach ($items as $item) {
        $receipt .= "<li>$item</li>";
    }

    $receipt .= "</ul>
        <p><strong>Total Price:</strong> ₱" . number_format($price, 2) . "</p>";

    // Add reservation details to the receipt
    if (!empty($reservations)) {
        $receipt .= "<h3>Reservation Details:</h3><ul>";
        foreach ($reservations as $reservation) {
            $receipt .= "<li>Table {$reservation['table_number']}: {$reservation['date']} at {$reservation['time']} for {$reservation['guests']} people in {$reservation['location']}</li>";
        }
        $receipt .= "</ul>";
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pop.webG6@gmail.com';  // Your Gmail
        $mail->Password = 'kqcvyyyrdoemmjjs';     // Your app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your_email@gmail.com', 'PreOrder Pal');
        $mail->addAddress($email, $customer_name);

        $mail->isHTML(true);
        $mail->Subject = 'Your PreOrder Pal Receipt (Platter)';
        $mail->Body    = $receipt;

        $mail->send();

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Order Confirmed and Receipt Sent!',
                    text: 'Proceed to payment to complete your order.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    document.getElementById('payment-button').disabled = false;
                });
            });
        </script>";
    } catch (Exception $e) {
        echo "<script>alert('❌ Email could not be sent. Error: {$mail->ErrorInfo}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="preorder-pal-logo.png">
    <meta charset="UTF-8" />
    <title>Order Summary - PreOrder Pal</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f0f4f8, #e0eafc);
            color: #333;
            min-height: 100vh;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, #004080, #0059b3);
            color: white;
            padding: 15px 30px;
        }
        .site-name {
            font-size: 1.6rem;
            font-weight: 600;
        }
        .order-summary {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            text-align: center;
        }
        .platter-details {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            text-align: left;
        }
        .platter-details ul {
            padding-left: 20px;
            list-style: disc;
        }
        .continue-button {
            background: linear-gradient(90deg, #004080, #0059b3);
            color: white;
            border: none;
            padding: 14px 40px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 30px;
            cursor: pointer;
            margin: 10px auto;
            display: block;
            width: fit-content;
        }
        .continue-button:hover:not(:disabled) {
            background: #003366;
            transform: scale(1.05);
        }
        .continue-button:disabled {
            background: #a2b9d3;
            cursor: not-allowed;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="site-name">PreOrder Pal</div>
    </nav>

    <section class="order-summary">
        <h1>Order Summary</h1>

        <div class="platter-details">
            <h2><?= htmlspecialchars($title); ?></h2>
            <ul>
                <?php foreach ($items as $item): ?>
                    <li><?= htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Total: ₱<?= number_format($price, 2); ?></strong></p>
        </div>

        <h2>Reservation Details</h2>
        <div class="platter-details">
            <ul>
                <?php foreach ($reservations as $reservation): ?>
                    <li>Table <?= $reservation['table_number']; ?>: <?= $reservation['date']; ?> at <?= $reservation['time']; ?> for <?= $reservation['guests']; ?> people in <?= $reservation['location']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <h2>Customer Details</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <button type="submit" class="continue-button">Confirm Order and Send Receipt</button>
        </form>

        <button id="payment-button" class="continue-button" disabled onclick="askPaymentMethod()">Proceed to Payment</button>
        <button type="button" class="continue-button" onclick="window.location.href='family_platters.php'">Go Back</button>
    </section>

    <script>
    function askPaymentMethod() {
        Swal.fire({
            title: 'How would you like to pay?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Pay at the Restaurant',
            cancelButtonText: 'Pay Online'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Thank you!', 'Please pay at the restaurant.', 'success').then(() => {
                    window.location.href = 'dashboard.php';
                });
            } else {
                window.location.href = 'payment.php';
            }
        });
    }
    </script>
</body>
</html>

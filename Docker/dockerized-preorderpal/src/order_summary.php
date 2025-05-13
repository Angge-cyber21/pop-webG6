<?php
session_start();

// DEBUG: Show session contents to verify 'selected_restaurant'
echo "<pre>";
// print_r($_SESSION);
echo "</pre>";

// OPTIONAL: Hardcode for test (REMOVE THIS in production)
// $_SESSION['selected_restaurant'] = 'Wanam sa Bukid';

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// DB connection
$host = 'localhost';
$dbname = 'preorder_pal';
$username = 'root';
$password = 'Mayyra21aaaAngge';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Get session values
$restaurant = $_SESSION['selected_restaurant'] ?? 'N/A';
$main_item = $_SESSION['selected_item'] ?? 'N/A';
$main_size = $_SESSION['selected_size'] ?? 'N/A';
$main_price = $_SESSION['price'] ?? 0;

$drink = $_SESSION['selected_drink'] ?? null;
$drink_price = $_SESSION['drink_price'] ?? 0;

$dessert = $_SESSION['selected_dessert'] ?? null;
$dessert_price = $_SESSION['dessert_price'] ?? 0;

$total = $main_price + $drink_price + $dessert_price;
$_SESSION['total'] = $total;

$reservations = $_SESSION['reservation'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO orders 
        (customer_name, email, restaurant, main_item, main_size, main_price, drink, drink_price, dessert, dessert_price, total_price) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $customer_name, $email, $restaurant,
        $main_item, $main_size, $main_price,
        $drink, $drink_price, $dessert, $dessert_price, $total
    ]);

    $order_id = $pdo->lastInsertId();

    $resStmt = $pdo->prepare("INSERT INTO order_reservations 
        (order_id, table_number, date, time, guests, location)
        VALUES (?, ?, ?, ?, ?, ?)");

    foreach ($reservations as $res) {
        $resStmt->execute([
            $order_id,
            $res['table_number'],
            $res['date'],
            $res['time'],
            $res['guests'],
            $res['location']
        ]);
    }

    $receipt = "
        <h2>Order Receipt</h2>
        <p><strong>Name:</strong> $customer_name</p>
        <p><strong>Restaurant:</strong> $restaurant</p>
        <p><strong>Main:</strong> $main_item ($main_size) - ₱" . number_format($main_price, 2) . "</p>";

    if ($drink) {
        $receipt .= "<p><strong>Drink:</strong> $drink - ₱" . number_format($drink_price, 2) . "</p>";
    }

    if ($dessert) {
        $receipt .= "<p><strong>Dessert:</strong> $dessert - ₱" . number_format($dessert_price, 2) . "</p>";
    }

    $receipt .= "<p><strong>Total:</strong> ₱" . number_format($total, 2) . "</p>";

    $receipt .= "<h3>Table Reservations</h3>";
    foreach ($reservations as $res) {
        $receipt .= "<p>Table: {$res['table_number']} | Date: {$res['date']} | Time: {$res['time']} | Guests: {$res['guests']} | Location: {$res['location']}</p>";
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pop.webG6@gmail.com';
        $mail->Password = 'kqcvyyyrdoemmjjs';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your_email@gmail.com', 'PreOrder Pal');
        $mail->addAddress($email, $customer_name);
        $mail->isHTML(true);
        $mail->Subject = 'Your PreOrder Pal Receipt';
        $mail->Body = $receipt;
        $mail->send();

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Order placed!',
                text: 'A receipt has been sent to your email.',
                confirmButtonText: 'OK'
            }).then(() => {
                document.getElementById('payment-button').disabled = false;
            });
        });
        </script>
        ";
    } catch (Exception $e) {
        echo "<script>alert('Email failed: {$mail->ErrorInfo}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Summary</title>
    <link rel="icon" type="image/png" href="new-logo.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f8fb;
            margin: 0;
            padding: 30px;
        }

        .container {
            background: #fff;
            max-width: 700px;
            margin: auto;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h1 {
            color: #004080;
            margin-bottom: 20px;
            text-align: center;
        }

        h2 {
            color: #004080;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 6px;
            margin-top: 30px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 8px 0;
        }

        .total {
            font-size: 20px;
            color: #0066cc;
            font-weight: bold;
            margin-top: 15px;
        }

        form input {
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        form button, #payment-button {
            margin-top: 20px;
            padding: 14px;
            font-size: 16px;
            width: 100%;
            background-color: #004080;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover, #payment-button:hover {
            background-color: #002d59;
        }

        #payment-button:disabled {
            background-color: #888;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Order Summary</h1>
    <p><strong>Restaurant:</strong> <?= htmlspecialchars($restaurant) ?></p>
    <p><strong>Main:</strong> <?= htmlspecialchars($main_item) ?> (<?= htmlspecialchars($main_size) ?>) - ₱<?= number_format($main_price, 2) ?></p>
    <p><strong>Drink:</strong> <?= htmlspecialchars($drink ?? 'None') ?> - ₱<?= number_format($drink_price, 2) ?></p>
    <p><strong>Dessert:</strong> <?= htmlspecialchars($dessert ?? 'None') ?> - ₱<?= number_format($dessert_price, 2) ?></p>
    <div class="total">Total: ₱<?= number_format($total, 2) ?></div>

    <h2>Table Reservations</h2>
    <?php if (!empty($reservations)): ?>
        <?php foreach ($reservations as $res): ?>
            <p>
                Table <?= htmlspecialchars($res['table_number']) ?> |
                <?= htmlspecialchars($res['date']) ?> at <?= htmlspecialchars($res['time']) ?> |
                Guests: <?= htmlspecialchars($res['guests']) ?> |
                Location: <?= htmlspecialchars($res['location']) ?>
            </p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No reservation info available.</p>
    <?php endif; ?>

    <h2>Customer Info</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <button type="submit">Confirm Order & Send Receipt</button>
    </form>

    <button id="payment-button" disabled onclick="askPaymentMethod()">Proceed to Payment</button>
</div>

<script>
function askPaymentMethod() {
    Swal.fire({
        title: 'Choose Payment Method',
        text: 'Would you like to pay at the restaurant or online?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Pay at Restaurant',
        cancelButtonText: 'Pay Online'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Reserved!', 'Please pay at the restaurant.', 'success')
                .then(() => { window.location.href = 'dashboard.php'; });
        } else {
            window.location.href = 'payment.php';
        }
    });
}
</script>

</body>
</html>

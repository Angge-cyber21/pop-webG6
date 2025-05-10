<?php
session_start();
include 'config.php';

$userName = $_SESSION['user_name'] ?? 'Guest';
$userEmail = $_SESSION['user_email'] ?? 'No email provided';
$paymentMethod = $_SESSION['payment_method'] ?? 'N/A';

// Fetch order details from database
$orderDetails = "";
$totalAmount = 0;

if ($userEmail !== 'No email provided') {
    $stmt = $conn->prepare("SELECT item_name, quantity, total_price FROM orders WHERE user_email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $orderDetails .= "Your Order Summary:\n\n";
        while ($row = $result->fetch_assoc()) {
            $item = $row['item_name'];
            $qty = $row['quantity'];
            $price = $row['total_price'];
            $totalAmount += $price;
            $orderDetails .= "- $item x$qty = ₱$price\n";
        }
        $orderDetails .= "\nTotal: ₱" . number_format($totalAmount, 2) . "\n";
    } else {
        $orderDetails = "No order details found.";
    }
    $stmt->close();
}

// Send email confirmation
$to = $userEmail;
$subject = "PreOrder Pal - Payment Confirmation";
$message = "Hi $userName,\n\nThank you for your payment via $paymentMethod.\n\n$orderDetails\nWe'll be preparing your order shortly.\n\nBest regards,\nPreOrder Pal Team";
$headers = "From: no-reply@preorderpal.com";

@mail($to, $subject, $message, $headers); // For production, consider using PHPMailer
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: 'Thank you for your payment!',
                text: 'A confirmation has been sent to your email.',
                icon: 'success',
                confirmButtonText: 'Go to Dashboard'
            }).then(() => {
                window.location.href = 'dashboard.php';
            });
        });
    </script>
</head>
<body>
</body>
</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Confirmation</title>
</head>
<body>
    <h1>Payment Confirmation</h1>
    <?php
    if (isset($_SESSION['success'])) {
        echo "<p>{$_SESSION['success']}</p>";
        unset($_SESSION['success']);
    } else {
        echo "<p>Payment failed. Please try again.</p>";
    }
    ?>
    <a href="index.php">Go to Home</a>
</body>
</html>

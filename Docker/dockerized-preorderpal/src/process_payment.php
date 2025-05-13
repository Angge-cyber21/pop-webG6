<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "root"; // Adjust if different
$password = "";     // Adjust if needed
$dbname = "restaurant_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure all expected POST data is available
if (isset($_POST['name'], $_POST['address'], $_POST['payment-method'])) {
    $fullname = trim($_POST['name']);
    $address = trim($_POST['address']);
    $paymentMethod = $_POST['payment-method'];
    $email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'noemail@example.com';

    // Insert payment into DB
    $stmt = $conn->prepare("INSERT INTO payments (fullname, email, payment_method) VALUES (?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $paymentMethod);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        // Redirect to thank you page
        header("Location: thank_you.php");
        exit();
    } else {
        $stmt->close();
        $conn->close();
        // Handle error with SweetAlert2
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong while processing your payment.',
            }).then(() => {
                window.location.href = 'payment.php';
            });
        </script>";
    }
} else {
    // Missing form data
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Incomplete Form',
            text: 'Please fill in all required fields.',
        }).then(() => {
            window.location.href = 'payment.php';
        });
    </script>";
}
?>

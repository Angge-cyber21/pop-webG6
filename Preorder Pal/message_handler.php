<?php
// Connect to the database
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "preorder pal"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values from the form
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Store the message in the database
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Send email notification
        $to = "admin@example.com"; // Change this to the admin's email
        $subject = "New Message from PreOrder Pal";
        $body = "You have received a new message:\n\n" .
                "Name: $name\n" .
                "Email: $email\n\n" .
                "Message:\n$message";
        $headers = "From: pop.webG6@gmail.com"; // Change this to your actual sender's email

        if (mail($to, $subject, $body, $headers)) {
            // Email sent successfully
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <title>Message Received</title>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: 'Message Sent!',
                        text: 'Thank you, " . addslashes($name) . "! We will get back to you shortly.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'dashboard.php';
                    });
                </script>
            </body>
            </html>
            ";
        } else {
            // Error sending email
            echo "
            <script>
                alert('Error sending email notification!');
                window.location.href = 'dashboard.php';
            </script>
            ";
        }
    } else {
        // Error storing message in database
        echo "
        <script>
            alert('Error storing your message. Please try again later.');
            window.location.href = 'dashboard.php';
        </script>
        ";
    }

    // Close the prepared statement and the connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect back if the page is accessed directly
    header("Location: dashboard.php");
    exit();
}

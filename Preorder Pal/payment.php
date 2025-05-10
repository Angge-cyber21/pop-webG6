<?php
session_start();

// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userName = 'Guest';
$userEmail = 'No email provided';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT fullname, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($fetchedFullName, $fetchedEmail);

    if ($stmt->fetch()) {
        $userName = $fetchedFullName;
        $userEmail = $fetchedEmail;
    }

    $stmt->close();
}

// Handle POST form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['payment-method'])) {
        $name = $_POST['name'];
        $payment_method = $_POST['payment-method'];
        $email = $userEmail;
        $payment_date = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO payments (fullname, email, payment_method, payment_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $payment_method, $payment_date);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Payment saved!',
                    text: 'Thank you!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'thank_you.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Try again later.',
                    confirmButtonText: 'OK'
                });
            </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Missing Info!',
                text: 'Fill in all required fields.',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>PreOrder Pal - Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #004080;
            color: white;
            padding: 15px 20px;
            text-align: left;
            font-size: 1.8rem;
            font-weight: bold;
        }

        main {
            flex-grow: 1;
            padding: 20px;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form textarea {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .payment-methods {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .payment-method {
            flex: 1 1 45%;
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 10px;
            transition: border-color 0.3s ease;
            background-color: #f0f0f0;
        }

        .payment-method.selected {
            border-color: #004080;
            background-color: #d0e1ff;
        }

        .payment-method img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            object-fit: contain;
        }

        .payment-method label {
            font-size: 1.1rem;
            cursor: pointer;
        }

        .continue-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #004080;
            color: white;
            font-size: 1.2rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .continue-button:hover {
            background-color: #003060;
        }

        .return-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #888888;
            color: white;
            font-size: 1.2rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .return-button:hover {
            background-color: #666666;
        }

        footer {
            background-color: #004080;
            color: white;
            text-align: center;
            padding: 15px 10px;
            margin-top: auto;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <header>PreOrder Pal - Payment</header>
    <main>
        <h1>Welcome, <?php echo htmlspecialchars($userName); ?>!</h1>
        <p>Your email: <?php echo htmlspecialchars($userEmail); ?></p>
        <form id="payment-form" method="POST" action="payment.php">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userName); ?>" placeholder="Your full name" required />

            <label>Choose Payment Method</label>
            <div class="payment-methods">
                <div class="payment-method" data-method="gcash" tabindex="0">
                    <input type="radio" id="gcash" name="payment-method" value="gcash" hidden />
                    <img src="https://framerusercontent.com/images/oxd8cAOU6GspubnNeZ9cGb29A.png" alt="GCash" />
                    <label for="gcash">GCash</label>
                </div>
                <div class="payment-method" data-method="paypal" tabindex="0">
                    <input type="radio" id="paypal" name="payment-method" value="paypal" hidden />
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" />
                    <label for="paypal">PayPal</label>
                </div>
                <div class="payment-method" data-method="credit-card" tabindex="0">
                    <input type="radio" id="credit-card" name="payment-method" value="credit-card" hidden />
                    <img src="https://media.gettyimages.com/id/1779996890/photo/bath-united-kingdom-in-this-photo-illustration-the-visa-mastercard-and-american-express-logos.jpg?s=612x612&w=gi&k=20&c=Q-ZrjkJtTiJG8OsS0Oqqqya8ElLsf-fzdZ15gJBpNts=" alt="Credit Card" />
                    <label for="credit-card">Credit Card</label>
                </div>
                <div class="payment-method" data-method="cash" tabindex="0">
                    <input type="radio" id="cash" name="payment-method" value="cash" hidden />
                    <img src="https://images.esquiremag.ph/esquiremagph/images/2024/12/20/bank-note-esquire-main-image-1734674139.jpg" alt="Cash" />
                    <label for="cash">Cash</label>
                </div>
            </div>

            <button type="submit" class="continue-button">Continue</button>
            <button type="button" class="return-button" onclick="window.location.href='dashboard.php'">Return</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 PreOrder Pal. All rights reserved.</p>
    </footer>

    <script>
    document.getElementById("payment-form").addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent default submit

        Swal.fire({
            title: 'How would you like to pay?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Pay Online',
            cancelButtonText: 'Pay at Counter',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit to payment.php
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'Payment Method',
                    text: 'You chose to pay at the counter.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = "counter_confirmation.php";
                });
            }
        });
    });
    </script>

</body>
</html>

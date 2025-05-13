<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "Mayyra21aaaAngge";
$dbname = "restaurant_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default values
$userName = 'Guest';
$userEmail = 'No email provided';
$userPhone = 'No phone provided';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT fullname, email, phone FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($fetchedFullName, $fetchedEmail, $fetchedPhone);
    if ($stmt->fetch()) {
        $userName = $fetchedFullName;
        $userEmail = $fetchedEmail;
        $userPhone = $fetchedPhone;
    }
    $stmt->close();
}

$total_price = $_SESSION['total'] ?? 0;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment_method'], $_POST['name'])) {
    $name = $_POST['name'];
    $method = $_POST['payment_method'];
    $email = $userEmail;
    $payment_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO payments (fullname, email, payment_method, payment_date, total_paid) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $name, $email, $method, $payment_date, $total_price);     
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "<script>
        localStorage.setItem('paymentSuccess', '1');
        localStorage.setItem('receiptData', JSON.stringify({
            name: '$name',
            email: '$email',
            phone: '$userPhone',
            method: '$method',
            total: '$total_price',
            date: '$payment_date'
        }));
        window.location.href = 'payment.php';
    </script>";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="new-logo.png">
    <meta charset="UTF-8">
    <title>PreOrder Pal - Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header, footer {
            background: #004080;
            color: white;
            padding: 15px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h1 {
            text-align: center;
        }

        form label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }

        form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .payment-method label {
            display: block;
            text-align: center;
            border: 2px solid #ccc;
            padding: 15px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-method input[type="radio"] {
            display: none;
        }

        .payment-method input[type="radio"]:checked + img,
        .payment-method input[type="radio"]:checked + img + div {
            outline: 3px solid #004080;
            background: #e6f0ff;
        }

        .payment-method img {
            width: 100%;
            height: 60px;
            object-fit: contain;
            margin-bottom: 5px;
        }

        .continue-button, .return-button {
            padding: 12px 24px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border: none;
            border-radius: 6px;
        }

        .continue-button {
            background: #28a745;
            color: white;
        }

        .return-button {
            background: #6c757d;
            color: white;
            margin-left: 10px;
        }

        #receipt {
            display: none;
            margin-top: 30px;
            border-top: 1px dashed #aaa;
            padding-top: 20px;
        }

        #receipt h2 {
            text-align: center;
        }

        #receipt-content {
            font-size: 16px;
            line-height: 1.6;
        }

        #print-btn {
            display: none;
            margin-top: 15px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #receipt, #receipt * {
                visibility: visible;
            }

            #receipt {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            #print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <header>PreOrder Pal - Payment</header>
    <main>
        <h1>Welcome, <?= htmlspecialchars($userName); ?>!</h1>
        <p>Your email: <?= htmlspecialchars($userEmail); ?></p>

        <form id="payment-form" method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($userName); ?>" required>

            <label>Select Payment Method</label>
            <div class="payment-methods">
                <div class="payment-method">
                    <label>
                        <input type="radio" name="payment_method" value="Gcash">
                        <img src="https://framerusercontent.com/images/oxd8cAOU6GspubnNeZ9cGb29A.png" alt="GCash">
                        <div>GCash</div>
                    </label>
                </div>
                <div class="payment-method">
                    <label>
                        <input type="radio" name="payment_method" value="Paypal">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal">
                        <div>PayPal</div>
                    </label>
                </div>
                    </label>
                </div>
            </div>

            <button type="submit" class="continue-button">Continue</button>
            <button type="button" class="return-button" onclick="window.location.href='dashboard.php'">Return</button>
        </form>

        <div id="receipt">
            <h2>Receipt</h2>
            <div id="receipt-content"></div>
            <button id="print-btn" onclick="window.print()">Print Receipt</button>
        </div>
    </main>
    <footer>&copy; <?= date('Y'); ?> PreOrder Pal. All rights reserved.</footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('paymentSuccess') === '1') {
                const data = JSON.parse(localStorage.getItem('receiptData') || '{}');
                localStorage.removeItem('paymentSuccess');
                localStorage.removeItem('receiptData');

                Swal.fire({
                    icon: 'success',
                    title: 'Payment recorded successfully!',
                    text: 'Generating receipt...',
                    timer: 2000,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    const receiptContent = document.getElementById("receipt-content");
                    receiptContent.innerHTML = `
                        <strong>Name:</strong> ${data.name}<br>
                        <strong>Email:</strong> ${data.email}<br>
                        <strong>Phone:</strong> ${data.phone}<br>
                        <strong>Payment Method:</strong> ${data.method}<br>
                        <strong>Total Paid:</strong> ₱${parseFloat(data.total).toFixed(2)}<br>
                        <strong>Date:</strong> ${data.date}
                    `;
                    document.getElementById("receipt").style.display = "block";
                    document.getElementById("print-btn").style.display = "inline-block";
                }, 2000);
            }
        });
    </script>
</body>
</html>
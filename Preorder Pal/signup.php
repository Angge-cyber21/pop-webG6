<?php
require_once('config.php');

$signupSuccess = null;
$signupError = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);

    if ($stmt->execute([$fullname, $email, $phone, $password])) {
        $signupSuccess = true;
    } else {
        $signupError = "Could not register. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Sign Up - PreOrder Pal</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
        }

        .container {
            max-width: 400px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            animation: fadeSlide 1s ease-in-out;
        }

        .welcome-message {
            text-align: center;
            margin-bottom: 30px;
            animation: fadeSlide 1.2s ease-in-out;
        }

        .welcome-message h1 {
            font-size: 1.8rem;
            color: #004080;
            margin: 0;
        }

        .welcome-message h1 span {
            color: #007bff;
            font-weight: bold;
        }

        .welcome-message p {
            color: #555;
            font-size: 1rem;
            margin-top: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #004080;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #004080;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #003060;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #004080;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-message">
            <h1>Welcome to <span>PreOrder Pal</span>!</h1>
            <p>Reserve your dining experience with ease.</p>
        </div>

        <h2>Sign Up</h2>
        <form method="POST" action="signup.php">
            <input type="text" name="fullname" placeholder="Full Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="text" name="phone" placeholder="Phone Number" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Create Account</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>

    <?php if ($signupSuccess): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Account Created',
                text: 'Redirecting to login...',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'login.php';
            });
        </script>
    <?php elseif ($signupError): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Sign Up Failed',
                text: '<?= $signupError ?>'
            });
        </script>
    <?php endif; ?>
</body>
</html>

<?php
require_once('config.php');
session_start();

$loginSuccess = null;
$errorMsg = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF token check (optional, but recommended for forms)
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errorMsg = "Invalid request. Please refresh and try again.";
    } else {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $loginSuccess = true;

            // OPTIONAL: Set a remember me cookie
            // setcookie("user_token", bin2hex(random_bytes(32)), time() + (86400 * 30), "/");
        } else {
            $errorMsg = "Invalid email or password.";
        }
    }
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - PreOrder Pal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="assets/images/new-logo.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #c2e9fb, #81a4fd);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 80px auto;
            background: white;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #004080;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #004080;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #005cbf;
        }

        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #004080;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .container {
                margin: 30px 15px;
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login to PreOrder Pal</h2>
        <form method="POST" action="login.php" autocomplete="on">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email" />

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password" />

            <!-- Optional: Remember me -->
            <!-- <label><input type="checkbox" name="remember"> Remember Me</label> -->

            <button type="submit">Login</button>
        </form>
        <a href="signup.php">Don't have an account? Sign up</a>
    </div>

    <?php if ($loginSuccess): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login Successful',
                text: 'Redirecting to dashboard...',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'dashboard.php';
            });
        </script>
    <?php elseif ($errorMsg): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: '<?= htmlspecialchars($errorMsg) ?>'
            });
        </script>
    <?php endif; ?>
</body>
</html>

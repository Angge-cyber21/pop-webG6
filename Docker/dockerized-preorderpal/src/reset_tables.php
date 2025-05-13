<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo->exec("UPDATE restaurant_tables SET is_available = 1");
    $success = "All tables have been reset to available.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Table Availability</title>
    <style>
        body {
            font-family: Arial;
            background-color: #eef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .panel {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            text-align: center;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        p {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <div class="panel">
        <h2>Admin Panel</h2>
        <form method="POST">
            <button type="submit">Reset All Table Availability</button>
        </form>
        <?php if (!empty($success)) echo "<p>$success</p>"; ?>
    </div>
</body>
</html>

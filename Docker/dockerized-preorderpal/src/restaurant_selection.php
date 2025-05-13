<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

// Handle reservation or reset
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['restaurant_name'], $_POST['table_number']) && !isset($_POST['reset_table'])) {
        $restaurant = $_POST['restaurant_name'];
        $table_number = $_POST['table_number'];
        $customer_name = 'Sample User';  // Replace with actual customer name if available
        $reservation_time = date('Y-m-d H:i:s');

        // Update table availability
        $stmt = $pdo->prepare("UPDATE restaurant_tables SET is_available = 0 WHERE restaurant_name = ? AND table_number = ?");
        $stmt->execute([$restaurant, $table_number]);

        // Insert reservation
        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, restaurant_name, table_number, created_at) VALUES (?, ?, ?, ?)");
        $stmt->execute([$customer_name, $restaurant, $table_number, $reservation_time]);

        // Store in session
        $_SESSION['restaurant'] = $restaurant;
        $_SESSION['table_number'] = $table_number;
        $_SESSION['customer_name'] = $customer_name;

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Table $table_number at $restaurant has been reserved.',
                icon: 'success',
                confirmButtonText: 'Continue to Menu'
            }).then(() => {
                window.location.href = 'wanam_menu.php';
            });
        </script>";
        exit;
    } elseif (isset($_POST['reset_table'])) {
        $stmt = $pdo->prepare("UPDATE restaurant_tables SET is_available = 1 WHERE restaurant_name = ? AND table_number = ?");
        $stmt->execute([$_POST['restaurant_name'], $_POST['table_number']]);
    }
}

// Fetch restaurants
$stmt = $pdo->query("SELECT DISTINCT restaurant_name FROM restaurant_tables");
$restaurants = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Restaurant - PreOrder Pal</title>
    <link rel="icon" href="new-logo.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header, footer {
            background: #004080;
            color: white;
            text-align: center;
            padding: 20px;
        }
        main {
            padding: 40px;
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h2 { color: #004080; margin-bottom: 10px; }
        .restaurant {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }
        .available { color: green; }
        .unavailable { color: red; }
        .reset-btn, .choose-btn {
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            color: white;
        }
        .reset-btn { background-color: #dc3545; }
        .choose-btn { background-color: #007bff; }
    </style>
</head>
<body>

<header><h1>📍 Table Availability - PreOrder Pal</h1></header>

<main>
    <?php if (empty($restaurants)): ?>
        <p>No restaurants found in the database.</p>
    <?php else: ?>
        <?php foreach ($restaurants as $restaurant): ?>
            <div class="restaurant">
                <h2><?= htmlspecialchars($restaurant) ?></h2>
                <?php
                $stmt = $pdo->prepare("SELECT table_number, is_available FROM restaurant_tables WHERE restaurant_name = ?");
                $stmt->execute([$restaurant]);
                $tables = $stmt->fetchAll();

                if (empty($tables)) {
                    echo "<p>No tables available.</p>";
                } else {
                    echo "<table>
                            <tr><th>Table</th><th>Status</th><th>Action</th></tr>";
                    foreach ($tables as $table):
                        $num = $table['table_number'];
                        $isAvail = $table['is_available'];
                        echo "<tr>
                                <td>Table $num</td>
                                <td class='" . ($isAvail ? 'available' : 'unavailable') . "'>" .
                                    ($isAvail ? 'Available ✅' : 'Unavailable ❌') .
                                "</td>
                                <td>
                                    <form method='POST'>
                                        <input type='hidden' name='restaurant_name' value='" . htmlspecialchars($restaurant) . "'>
                                        <input type='hidden' name='table_number' value='$num'>";
                        if ($isAvail) {
                            echo "<button type='submit' class='choose-btn'>Reserve</button>";
                        } else {
                            echo "<button type='submit' name='reset_table' class='reset-btn'>Reset</button>";
                        }
                        echo "</form></td></tr>";
                    endforeach;
                    echo "</table>";
                }
                ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <hr>
    <h2>🧾 All Reservations</h2>
    <?php
    $stmt = $pdo->query("SELECT customer_name, restaurant_name, table_number, created_at FROM orders ORDER BY created_at DESC");
    $reservations = $stmt->fetchAll();

    if (empty($reservations)) {
        echo "<p>No reservations yet.</p>";
    } else {
        echo "<table>
                <tr><th>Name</th><th>Restaurant</th><th>Table</th><th>Time</th></tr>";
        foreach ($reservations as $r) {
            echo "<tr>
                    <td>" . htmlspecialchars($r['customer_name']) . "</td>
                    <td>" . htmlspecialchars($r['restaurant_name']) . "</td>
                    <td>" . htmlspecialchars($r['table_number']) . "</td>
                    <td>" . htmlspecialchars($r['created_at']) . "</td>
                  </tr>";
        }
        echo "</table>";
    }
    ?>
</main>

<footer><p>&copy; 2025 PreOrder Pal</p></footer>

</body>
</html>

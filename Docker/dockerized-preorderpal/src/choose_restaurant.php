<?php
require_once 'db.php';

// Handle reservation request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['restaurant_name'], $_POST['table_number']) && !isset($_POST['reset_table'])) {
        $restaurant = $_POST['restaurant_name'];
        $table_number = $_POST['table_number'];
        $customer_name = 'Sample User'; // Replace with actual user name if needed
        $reservation_time = date('Y-m-d H:i:s'); // Current time when the reservation is made

        // Mark the table as unavailable
        $stmt = $pdo->prepare("UPDATE restaurant_tables SET is_available = 0 WHERE restaurant_name = ? AND table_number = ?");
        $stmt->execute([$restaurant, $table_number]);

        // Insert reservation details into the orders table
        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, restaurant_name, table_number, created_at) VALUES (?, ?, ?, ?)");
        $stmt->execute([$customer_name, $restaurant, $table_number, $reservation_time]);

        // Show SweetAlert confirmation and redirect
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Table $table_number at $restaurant has been reserved.',
                icon: 'success',
                confirmButtonText: 'Continue to Menu'
            }).then(() => {
                window.location.href = 'wanam_menu.php'; // Adjust if needed
            });
        </script>";
        exit;
    } elseif (isset($_POST['reset_table'])) {
        // Reset table to available
        $stmt = $pdo->prepare("UPDATE restaurant_tables SET is_available = 1 WHERE restaurant_name = ? AND table_number = ?");
        $stmt->execute([$_POST['restaurant_name'], $_POST['table_number']]);
    }
}

// Fetch all restaurants
$stmt = $pdo->query("SELECT DISTINCT restaurant_name FROM restaurant_tables");
$restaurants = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Choose Restaurant - PreOrder Pal</title>
        <link rel="icon" href="new-logo.png" type="image/png">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background: #f4f4f9;
                margin: 0;
                padding: 0;
                color: #333;
            }
            header {
                background: #004080;
                color: white;
                text-align: center;
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            footer {
                background: linear-gradient(135deg, #004080, #003366);
                color: white;
                text-align: center;
                padding: 20px 0;
                font-size: 16px;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
                margin-top: 40px;
            }
            footer p {
                margin: 0;
                font-weight: 500;
            }
            main {
                padding: 40px;
                max-width: 900px;
                margin: 0 auto;
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #004080;
                font-size: 24px;
                margin-bottom: 10px;
            }
            .restaurant {
                background: white;
                border-radius: 10px;
                padding: 20px;
                margin-bottom: 30px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table th, table td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
                text-align: left;
            }
            .available {
                color: #28a745;
            }
            .unavailable {
                color: #dc3545;
            }
            .reset-btn {
                background-color: #dc3545;
                color: white;
                padding: 6px 10px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            .reset-btn:hover {
                background-color: #b02a37;
            }
            .choose-btn {
                background-color: #007bff;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 18px;
                margin-top: 20px;
                transition: background-color 0.3s;
            }
            .choose-btn:hover {
                background-color: #0056b3;
            }
            @media (max-width: 768px) {
                main {
                    padding: 20px;
                }
                .choose-btn {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>

    <header>
        <h1>📍 Table Availability - PreOrder Pal</h1>
    </header>

    <main>
        <button class="choose-btn" onclick="showRestaurantChoice()">Choose Your Restaurant</button>

        <div id="restaurant-list">
            <?php foreach ($restaurants as $restaurant): ?>
                <div class="restaurant">
                    <h2><?= htmlspecialchars($restaurant) ?></h2>
                    <?php
                    $stmt = $pdo->prepare("SELECT table_number, is_available FROM restaurant_tables WHERE restaurant_name = ?");
                    $stmt->execute([$restaurant]);
                    $tables = $stmt->fetchAll();

                    if (empty($tables)) {
                        echo "<p>No tables added to this restaurant yet.</p>";
                    } else {
                        echo "<table>
                                <tr>
                                    <th>Table Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>";
                        foreach ($tables as $table):
                            $isAvailable = $table['is_available'];
                            $tableNum = $table['table_number'];
                            echo "<tr>
                                <td>Table $tableNum</td>
                                <td class='" . ($isAvailable ? 'available' : 'unavailable') . "'>" . 
                                    ($isAvailable ? 'Available ✅' : 'Unavailable ❌') . 
                                "</td>
                                <td>";
                            if (!$isAvailable) {
                                echo "<form method='POST' style='margin: 0;'>
                                        <input type='hidden' name='restaurant_name' value='" . htmlspecialchars($restaurant) . "'>
                                        <input type='hidden' name='table_number' value='$tableNum'>
                                        <button type='submit' name='reset_table' class='reset-btn'>Reset</button>
                                    </form>";
                            } else {
                                echo "<form method='POST' style='margin: 0;'>
                                        <input type='hidden' name='restaurant_name' value='" . htmlspecialchars($restaurant) . "'>
                                        <input type='hidden' name='table_number' value='$tableNum'>
                                        <button type='submit' class='choose-btn'>Reserve</button>
                                    </form>";
                            }
                            echo "</td></tr>";
                        endforeach;
                        echo "</table>";
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>

        <hr style="margin: 40px 0;">

        <h2>🧾 All Table Reservations by Users</h2>
        <?php
        // Fetch the latest 10 reservations
        $stmt = $pdo->query("SELECT customer_name, restaurant_name, table_number, created_at FROM orders ORDER BY created_at DESC LIMIT 10");
        $reservations = $stmt->fetchAll();

        if (empty($reservations)) {
            echo "<p>No reservations made yet.</p>";
        } else {
            echo "<table>
                    <tr>
                        <th>Customer Name</th>
                        <th>Restaurant</th>
                        <th>Table Number</th>
                        <th>Reservation Time</th>
                    </tr>";
            foreach ($reservations as $res) {
                echo "<tr>
                        <td>" . htmlspecialchars($res['customer_name'] ?? ' ') . "</td>
                        <td>" . htmlspecialchars($res['restaurant_name'] ?? ' ') . "</td>
                        <td>" . htmlspecialchars($res['table_number'] ?? ' ') . "</td>
                        <td>" . htmlspecialchars($res['created_at'] ?? ' ') . "</td>
                    </tr>";
            }
            echo "</table>";
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2025 PreOrder Pal. All rights reserved.</p>
    </footer>

<script>
    function showRestaurantChoice() {
        Swal.fire({
            title: 'Choose Your Restaurant',
            input: 'select',
            inputOptions: {
                'Wanam sa Bukid': 'Wanam sa Bukid',
                'Butch': 'Butch'
            },
            inputPlaceholder: 'Select a restaurant...',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to select a restaurant!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Store the selected restaurant in session and redirect
                fetch('set_restaurant.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'selected_restaurant=' + encodeURIComponent(result.value)
                })
                .then(response => response.text())
                .then(data => {
                    if (result.value === 'Wanam sa Bukid') {
                        window.location.href = 'wanam_menu.php';
                    } else if (result.value === 'Butch') {
                        window.location.href = 'family_platters.php'; // Adjust accordingly for Butch's menu
                    }
                });
            }
        });
    }
</script>

</body>
</html>
<?php
require_once 'db.php';

// Handle reset table availability
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_table'])) {
    $restaurant = $_POST['restaurant_name'];
    $table_number = $_POST['table_number'];

    $stmt = $pdo->prepare("UPDATE restaurant_tables SET is_available = 1 WHERE restaurant_name = ? AND table_number = ?");
    $stmt->execute([$restaurant, $table_number]);

    header("Location: choose_restaurant.php");
    exit;
}

$restaurants = ['Wanam sa Bukid', 'Butch'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Restaurant - PreOrder Pal</title>
    <link rel="icon" href="preorder-pal-logo.png" type="image/png">
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
            background: linear-gradient(135deg, #004080, #003366); /* Gradient background */
            color: white;
            text-align: center;
            padding: 20px 0;  /* Increased padding for better spacing */
            font-size: 16px;   /* Slightly larger font size for readability */
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1); /* Light shadow effect */
            position: relative; /* Not fixed to allow content to scroll */
            margin-top: 40px; /* Added margin between content and footer */
        }
        footer p {
            margin: 0;
            font-weight: 500;  /* Bold text for copyright */
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
        .restaurant select {
            padding: 8px;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            width: 100%;
        }
        @media (max-width: 768px) {
            footer {
                font-size: 14px;  /* Slightly smaller font on mobile */
                padding: 15px 0;  /* Reduced padding for smaller screens */
            }
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
    <!-- Button to choose restaurant -->
    <button class="choose-btn" onclick="showRestaurantChoice()">Choose Your Restaurant</button>

    <div id="restaurant-list">
        <?php foreach ($restaurants as $restaurant): ?>
            <div class="restaurant">
                <h2><?= htmlspecialchars($restaurant) ?></h2>
                <?php
                // Fetch all tables for the current restaurant
                $stmt = $pdo->prepare("SELECT table_number, is_available FROM restaurant_tables WHERE restaurant_name = ?");
                $stmt->execute([$restaurant]);
                $tables = $stmt->fetchAll();

                // Check if there are tables for this restaurant
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
                            echo "—";
                        }
                        echo "</td></tr>";
                    endforeach;
                    echo "</table>";
                }
                ?>
            </div>
        <?php endforeach; ?>
    </div>
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
                Swal.fire(`You chose ${result.value}`);
            }
        });
    }
</script>

</body>
</html>

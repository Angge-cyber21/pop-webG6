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
    <title>Choose Restaurant - PreOrder Pal</title>
    <link rel="icon" href="new-logo.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }

        /* Header Styling */
        header {
            background: #004080;
            color: white;
            text-align: center;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 28px;
            margin: 0;
        }

        /* Footer Styling */
        footer {
            background: linear-gradient(135deg, #004080, #003366);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        /* Main Content Styling */
        main {
            padding: 30px;
            max-width: 900px;
            margin: auto;
            background: white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30px;
        }

        .restaurant {
            background: white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            animation: fadeIn 0.5s ease-in-out;
        }

        h2 {
            margin-bottom: 10px;
            color: #004080;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
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
            padding: 8px 12px;
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
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .choose-btn:hover {
            background-color: #0056b3;
        }

        /* Animation for fade-in effect */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design for Small Screens */
        @media (max-width: 768px) {
            header {
                padding: 15px;
            }

            main {
                padding: 20px;
                margin-top: 20px;
            }

            footer {
                font-size: 12px;
                padding: 15px;
            }

            .choose-btn {
                width: 100%;
                padding: 14px;
                font-size: 18px;
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
                        window.location.href = 'family_platters.php';
                    }
                });
            }
        });
    }
</script>

</body>
</html>

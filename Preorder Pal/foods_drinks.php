<?php
session_start();

// Step 1: Read reservation details from session
$reservations = $_SESSION['reservations'] ?? null;
if (!$reservations) {
    header("Location: table_reservation.php");
    exit();
}

// Step 2: Parse reservation data
$reservedTables = [];
foreach ($reservations as $key => $value) {
    if (strpos($key, 'date') === 0) {
        $tableNumber = str_replace('date', '', $key);
        $reservedTables[$tableNumber]['date'] = $value;
    } elseif (strpos($key, 'time') === 0) {
        $tableNumber = str_replace('time', '', $key);
        $reservedTables[$tableNumber]['time'] = $value;
    } elseif (strpos($key, 'people') === 0) {
        $tableNumber = str_replace('people', '', $key);
        $reservedTables[$tableNumber]['people'] = $value;
    } elseif (strpos($key, 'location') === 0) {
        $tableNumber = str_replace('location', '', $key);
        $reservedTables[$tableNumber]['location'] = $value;
    }
}

// Step 3: Handle restaurant form submission
$restaurantSelected = false;
$restaurantName = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['selected_restaurant'])) {
    $_SESSION['selected_restaurant'] = $_POST['selected_restaurant'];
    $_SESSION['restaurant_selected'] = true;
    $_SESSION['restaurant_name'] = $_POST['selected_restaurant'];

    if ($_POST['selected_restaurant'] === "Wanam sa Bukid") {
        header("Location: wanam_menu.php");
        exit();
    } elseif ($_POST['selected_restaurant'] === "Butch") {
        header("Location: family_platters.php");
        exit();
    } else {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_SESSION['restaurant_selected']) && $_SESSION['restaurant_selected']) {
    $restaurantSelected = true;
    $restaurantName = $_SESSION['restaurant_name'];
    unset($_SESSION['restaurant_selected'], $_SESSION['restaurant_name']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Foods & Drinks - PreOrder Pal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Styles -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header, footer {
            background-color: #004080;
            color: white;
            text-align: center;
            padding: 20px;
        }

        main {
            flex: 1;
            max-width: 1000px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .reservation-summary {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .reservation-summary h2 {
            margin-bottom: 15px;
            color: #004080;
        }

        .table-details {
            background: #e9f3ff;
            border-left: 5px solid #004080;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 6px;
        }

        .menu-section h3 {
            color: #28a745;
            margin-bottom: 15px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .restaurant-form {
            text-align: center;
        }

        .restaurant-form button {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            text-align: center;
            width: 140px;
            background-color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 10px;
            color: #004080;
            font-weight: bold;
            font-size: 1.1rem;
            border: none;
        }

        .restaurant-form img {
            width: 120px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .restaurant-form button:hover {
            box-shadow: 0 0 15px 3px #004080;
            transform: scale(1.05);
        }

        .continue-button {
            background-color: #004080;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 30px auto 10px;
        }

        .continue-button:hover {
            background-color: #003366;
        }
    </style>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>

<header>🍽️ Foods & Drinks</header>

<main>
<!-- Reservation Summary -->
<div class="reservation-summary">
    <h2>Thank you! Your table reservation is confirmed.</h2>
    <?php foreach ($reservedTables as $num => $details): ?>
        <div class="table-details">
            <strong>Table <?= $num ?>:</strong>
            <?= htmlspecialchars($details['date']) ?> at 
            <?= htmlspecialchars($details['time']) ?> for 
            <?= htmlspecialchars($details['people']) ?> 
            <?= $details['people'] == 1 ? 'person' : 'people' ?> 
            in the <?= htmlspecialchars($details['location']) ?>.
        </div>
    <?php endforeach; ?>

    <!-- Display Chosen Restaurant -->
    <div style="margin-top: 25px; text-align: center;">
        <script>
            const restaurant = localStorage.getItem('chosenRestaurant');
            if (restaurant) {
                document.write(`<h2>You are ordering from: <b>${restaurant}</b></h2>`);
            }
        </script>
    </div>
</div>


    <!-- Restaurant Selection -->
    <div class="menu-section">
        <h3>🥗 Choose Your Restaurant</h3>
        <div class="button-container">
            <form method="POST" class="restaurant-form">
                <input type="hidden" name="selected_restaurant" value="Wanam sa Bukid">
                <button type="submit">
                    <img src="images/wanam.jpg" alt="Wanam sa Bukid" />
                    Wanam sa Bukid
                </button>
            </form>

            <form method="POST" class="restaurant-form">
                <input type="hidden" name="selected_restaurant" value="Butch">
                <button type="submit">
                    <img src="images/butch.jpg" alt="Butch" />
                    Butch
                </button>
            </form>
        </div>
    </div>

    <!-- Continue Button -->
    <button id="dashboardBtn" class="continue-button">Go to Dashboard</button>
</main>

<footer>&copy; 2025 PreOrder Pal. All rights reserved.</footer>

<script>
    $(document).ready(function () {
        $('#dashboardBtn').on('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Go to Dashboard?',
                text: "You will be redirected to your dashboard.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#004080',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, go now'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboard.php';
                }
            });
        });

        // Custom SweetAlert on restaurant select
        $('.restaurant-form button').on('click', function (e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const restaurantName = form.find('input[name="selected_restaurant"]').val();

            let icon = 'info';
            let message = 'You selected ' + restaurantName;
            if (restaurantName === 'Wanam sa Bukid') {
                icon = 'success';
                message = 'Wanam sa Bukid – Traditional flavors await!';
            } else if (restaurantName === 'Butch') {
                icon = 'success';
                message = 'Butch – Meat lovers rejoice!';
            }

            Swal.fire({
                title: 'Confirm Selection',
                text: message,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#004080',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Flash message on successful selection
        <?php if ($restaurantSelected): ?>
        Swal.fire({
            icon: 'success',
            title: 'Restaurant Selected',
            text: '<?= htmlspecialchars($restaurantName) ?> selected successfully!',
            confirmButtonColor: '#004080',
            timer: 2000,
            showConfirmButton: false
        });
        <?php endif; ?>
    });
</script>

</body>
</html>

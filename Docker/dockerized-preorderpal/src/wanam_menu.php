<?php
session_start();
$menuData = [
    "Wanam Fried Rice" => [
        "prices" => ["Medium" => 180, "Large" => 240],
        "image" => "wanam fried rice.jfif"
    ],
    "Miki Bihon" => [
        "prices" => ["Regular" => 80, "Double" => 130, "Family" => 220],
        "image" => "wanam miki bihon.jfif"
    ],
    "Bihon solo" => [
        "prices" => ["Regular" => 80, "Double" => 130, "Family" => 220],
        "image" => "wanam bihon solo.jfif"
    ],
    "Wanam Fried Chicken" => [
        "prices" => ["Half" => 190, "Whole" => 380],
        "image" => "wanam fried chicken.jfif"
    ],
    "Lumpiang shanghai" => [
        "prices" => ["Regular" => 200],
        "image" => "wanam lumpia.jfif"
    ],
    "Pork Sisig" => [
        "prices" => ["Regular" => 220],
        "image" => "wanam pork sisig.jfif"
    ],
    "Pork BBQ" => [
        "prices" => ["Regular" => 220],
        "image" => "wanam pork bbq.jfif"
    ],
    "Crispy pata" => [
        "prices" => ["Regular" => 400],
        "image" => "wanam crispy pata.jfif"
    ],
    "Fish Fillet in Sweet and Sour Sauce" => [
        "prices" => ["Regular" => 220],
        "image" => "wanam fish fillet in swet and sour.jfif"
    ]
];
// Database connection
$host = 'localhost';
$dbname = 'preorder_pal';
$username = 'root';  // Use your database username
$password = 'Mayyra21aaaAngge';      // Use your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Redirect if no selected restaurant
if (!isset($_SESSION['selected_restaurant'])) {
    header("Location: foods_drinks.php");
    exit();
}

// Handle the selection of the main course
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_item']) && isset($_POST['selected_size'])) {
    $selected_item = $_POST['selected_item'];
    $selected_size = $_POST['selected_size'];
    $restaurant_name = $_SESSION['selected_restaurant'];

    // Get the price for the selected item and size
    $price = $menuData[$selected_item]['prices'][$selected_size];

    // Insert into the database
    $stmt = $pdo->prepare("INSERT INTO orders (restaurant_name, item_name, size, price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$restaurant_name, $selected_item, $selected_size, $price]);

    // Store selection in session for order summary
    $_SESSION['selected_item'] = $selected_item;
    $_SESSION['selected_size'] = $selected_size;
    $_SESSION['price'] = $price;

    header('Location: drinks_menu.php');
    exit();
}



$prices = array_map(fn($item) => $item['prices'], $menuData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="new-logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Course Menu - PreOrder Pal</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f4f8fb;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080;
            color: white;
            padding: 12px 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .navbar img.logo {
            height: 40px;
            margin-right: 12px;
        }

        .maincourse-section {
            max-width: 960px;
            margin: 40px auto;
            padding: 0 24px;
        }

        .maincourse-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-bottom: 30px;
        }

        .maincourse-button {
            all: unset;
            cursor: pointer;
            width: 160px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .maincourse-button:hover,
        .maincourse-button.selected {
            transform: scale(1.05);
            box-shadow: 0 0 10px #004080;
        }

        .maincourse-button img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        label {
            font-weight: 600;
            color: #004080;
            margin-bottom: 8px;
            display: block;
        }

        select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .price-display {
            font-weight: bold;
            font-size: 1.2rem;
            color: #004080;
            margin-bottom: 30px;
        }

        .continue-button {
            background-color: #004080;
            color: white;
            padding: 12px 24px;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 10px auto;
        }

        .continue-button:hover:not(:disabled) {
            background-color: #003366;
        }

        .continue-button:disabled {
            background-color: #b0c4de;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="left">
        <img src="preorder-pal-logo.png" alt="PreOrder Pal Logo" class="logo" />
        <span style="font-weight:600; font-size:1.2rem;">PreOrder Pal</span>
    </div>
</nav>

<section class="maincourse-section">
    <h1 style="text-align:center; color:#004080;">Choose Your Main Course</h1>
    <div class="maincourse-container" id="maincourseContainer">
        <?php foreach ($menuData as $item => $info): ?>
            <button class="maincourse-button" data-item="<?= $item ?>">
                <img src="<?= $info['image'] ?>" alt="<?= $item ?>">
                <div><?= $item ?></div>
            </button>
        <?php endforeach; ?>
    </div>

    <label for="sizeSelect">Select Size/Quantity:</label>
    <select id="sizeSelect" disabled>
        <option value="" disabled selected>Select size/quantity</option>
    </select>

    <div class="price-display" id="priceDisplay">Price: ₱0</div>

    <form method="POST" id="orderForm">
        <input type="hidden" name="selected_item" id="selectedItem">
        <input type="hidden" name="selected_size" id="selectedSize">
        <button type="submit" class="continue-button" id="continueButton" disabled>Continue</button>
    </form>
    <button class="continue-button" onclick="history.back()">Go Back</button>
</section>

<script>
    const menuData = <?= json_encode($menuData) ?>;
    const sizeSelect = document.getElementById('sizeSelect');
    const priceDisplay = document.getElementById('priceDisplay');
    const continueButton = document.getElementById('continueButton');
    const selectedItemField = document.getElementById('selectedItem');
    const selectedSizeField = document.getElementById('selectedSize');

    let selectedItem = null;
    let selectedSize = null;

    document.querySelectorAll('.maincourse-button').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.maincourse-button').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            selectedItem = button.getAttribute('data-item');

            const sizes = Object.entries(menuData[selectedItem].prices);
            sizeSelect.disabled = false;
            sizeSelect.innerHTML = '<option value="" disabled selected>Select size/quantity</option>';
            sizes.forEach(([size, price]) => {
                const opt = document.createElement('option');
                opt.value = size;
                opt.textContent = `${size} - ₱${price}`;
                opt.dataset.price = price;
                sizeSelect.appendChild(opt);
            });

            priceDisplay.textContent = "Price: ₱0";
            continueButton.disabled = true;
        });
    });

    sizeSelect.addEventListener('change', () => {
        selectedSize = sizeSelect.value;
        const price = sizeSelect.options[sizeSelect.selectedIndex].dataset.price;
        priceDisplay.textContent = `Price: ₱${price}`;
        continueButton.disabled = false;
    });

    document.getElementById('orderForm').addEventListener('submit', (e) => {
        e.preventDefault();
        if (!selectedItem || !selectedSize) {
            Swal.fire('Error', 'Please select a main course and size.', 'warning');
            return;
        }

        const price = sizeSelect.options[sizeSelect.selectedIndex].dataset.price;
        Swal.fire({
            title: 'Confirm Selection',
            html: `<strong>${selectedItem}</strong><br>Size: <strong>${selectedSize}</strong><br>Price: ₱${price}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                selectedItemField.value = selectedItem;
                selectedSizeField.value = selectedSize;
                e.target.submit();
            }
        });
    });
</script>
</body>
</html>

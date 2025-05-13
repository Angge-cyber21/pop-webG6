<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "Mayyra21aaaAngge", "preorder_pal");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Drink
    if (isset($_POST["drink"], $_POST["size"], $_POST["price"])) {
        $drink = $_POST["drink"];
        $size = $_POST["size"];
        $price = (int)$_POST["price"];
        $payment_method = $_POST["payment_method"] ?? "N/A";

        $_SESSION['order']['drink'] = [
            'name' => $drink,
            'size' => $size,
            'price' => $price
        ];
        $_SESSION['selected_drink'] = $drink;
        $_SESSION['drink_price'] = $price;
        

        $stmt = $conn->prepare("INSERT INTO drink_orders (drink_name, drink_size, price, payment_method) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $drink, $size, $price, $payment_method);
        $stmt->execute();
        $stmt->close();
    }

    // Dessert (optional)
    if (!empty($_POST["dessert"]) && isset($_POST["dessert_price"])) {
        $dessert = $_POST["dessert"];
        $dessert_price = (int)$_POST["dessert_price"];
        $dessert_payment_method = $_POST["payment_method"] ?? "N/A";

        $_SESSION['selected_dessert'] = $dessert;
        $_SESSION['dessert_price'] = $dessert_price;

        $stmt = $conn->prepare("INSERT INTO dessert_orders (dessert_name, price, payment_method) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $dessert, $dessert_price, $dessert_payment_method);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: order_summary.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="new-logo.png">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PreOrder Pal - Drinks & Desserts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .navbar {
            background-color: #003366;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .section h2 {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            color: #003366;
        }

        .item-button {
            text-align: center;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 15px;
            cursor: pointer;
            transition: 0.3s ease;
            width: 180px;
            margin: 10px;
            background-color: #ffffff;
        }

        .item-button:hover {
            background-color: #f1f1f1;
        }

        .item-button.selected {
            border-color: #004080;
            box-shadow: 0 0 15px rgba(0, 64, 128, 0.5);
        }

        .item-button img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        .price-display {
            font-weight: bold;
            color: #004080;
            text-align: center;
            margin-top: 20px;
        }

        .continue-button {
            width: 100%;
            background-color: #004080;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .continue-button:hover {
            background-color: #003366;
        }

        .continue-button:disabled {
            background-color: #a0b8d8;
            cursor: not-allowed;
        }

        .select-size {
            margin-top: 10px;
            text-align: center;
        }

        select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .item-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div>PreOrder Pal</div>
</nav>

<div class="container">
    <form id="orderForm" method="POST">
        <!-- Drink Section -->
        <section class="section" id="drinkSection">
            <h2>Drinks</h2>
            <div class="item-container" id="drinkContainer">
                <div class="item-button" data-drink="Coke" data-price="50">
                    <img src="wanam coke.jfif" alt="Coke" />
                    <div>Coke</div>
                </div>
                <div class="item-button" data-drink="Royal" data-price="50">
                    <img src="wanam royal.jfif" alt="Royal" />
                    <div>Royal</div>
                </div>
                <div class="item-button" data-drink="Sprite" data-price="50">
                    <img src="wanam sprite.jfif" alt="Sprite" />
                    <div>Sprite</div>
                </div>
                <div class="item-button" data-drink="Mountain Dew" data-price="50">
                    <img src="wanam mountain dew.jfif" alt="Mountain Dew" />
                    <div>Mountain Dew</div>
                </div>
                <div class="item-button" data-drink="Ice Tea" data-price="60">
                    <img src="wanam ice tea.jfif" alt="Ice Tea" />
                    <div>Ice Tea</div>
                </div>
            </div>

            <!-- Drink Size Selection -->
            <div class="select-size">
                <label for="sizeSelect">Select Size:</label>
                <select name="size" id="sizeSelect" required>
                    <option value="" disabled selected>Select size</option>
                    <option value="small" data-price="50">Small - ₱50</option>
                    <option value="medium" data-price="70">Medium - ₱70</option>
                    <option value="large" data-price="90">Large - ₱90</option>
                </select>
            </div>
        </section>

        <!-- Dessert Section -->
        <section class="section" id="dessertSection">
            <h2>Desserts</h2>
            <div class="item-container" id="dessertContainer">
                <div class="item-button" data-dessert="Chocolate Cake" data-price="120">
                    <img src="triple-chocolate-cake-4.jpg" alt="Chocolate Cake" />
                    <div>Chocolate Cake</div>
                </div>
                <div class="item-button" data-dessert="Ice Cream" data-price="80">
                    <img src="images (2).jpg" alt="Ice Cream" />
                    <div>Ice Cream</div>
                </div>
                <div class="item-button" data-dessert="Apple Pie" data-price="100">
                    <img src="images (3).jpg" alt="Apple Pie" />
                    <div>Apple Pie</div>
                </div>
                <div class="item-button" data-dessert="Fruit Salad" data-price="90">
                    <img src="wanam fruit salad.jfif" alt="Fruit Salad" />
                    <div>Fruit Salad</div>
                </div>
                <div class="item-button" data-dessert="Brownies" data-price="70">
                    <img src="fudgy-brown-butter-brownies-4134.jpg" alt="Brownies" />
                    <div>Brownies</div>
                </div>
                <div class="item-button" data-dessert="Leche Flan" data-price="110">
                    <img src="wanam leche flan.jpg" alt="Leche Flan" />
                    <div>Leche Flan</div>
                </div>
                <div class="item-button" data-dessert="Coffee Jelly" data-price="85">
                    <img src="wanam coffe jelly.jfif" alt="Coffee Jelly" />
                    <div>Coffee Jelly</div>
                </div>
            </div>
        </section>

        <!-- Price Summary -->
        <div class="price-display" id="priceDisplay">Total: ₱0</div>

        <!-- Hidden Inputs to Store Selections -->
        <input type="hidden" name="drink" id="drinkInput">
        <input type="hidden" name="price" id="priceInput">
        <input type="hidden" name="dessert" id="dessertInput">
        <input type="hidden" name="dessert_price" id="dessertPriceInput">
        
        <!-- Payment Method (hidden for now) -->
        <input type="hidden" name="payment_method">

        <button type="submit" class="continue-button" id="continueButton" disabled>Continue</button>
    </form>
</div>

<script>
    const drinkButtons = document.querySelectorAll('.item-button[data-drink]');
    const dessertButtons = document.querySelectorAll('.item-button[data-dessert]');
    const sizeSelect = document.getElementById('sizeSelect');
    const priceDisplay = document.getElementById('priceDisplay');
    const continueButton = document.getElementById('continueButton');
    const drinkInput = document.getElementById('drinkInput');
    const priceInput = document.getElementById('priceInput');
    const dessertInput = document.getElementById('dessertInput');
    const dessertPriceInput = document.getElementById('dessertPriceInput');

    let selectedDrinkPrice = 0;
    let selectedDessertPrice = 0;
    let selectedDrink = "";
    let selectedDessert = "";

    // Drink selection logic
    drinkButtons.forEach(button => {
        button.addEventListener('click', () => {
            drinkButtons.forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            selectedDrink = button.getAttribute('data-drink');
            selectedDrinkPrice = parseInt(button.getAttribute('data-price'));

            drinkInput.value = selectedDrink;
            priceInput.value = selectedDrinkPrice;
            updateTotalPrice();
        });
    });

    // Dessert selection logic
    dessertButtons.forEach(button => {
        button.addEventListener('click', () => {
            dessertButtons.forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            selectedDessert = button.getAttribute('data-dessert');
            selectedDessertPrice = parseInt(button.getAttribute('data-price'));

            dessertInput.value = selectedDessert;
            dessertPriceInput.value = selectedDessertPrice;
            updateTotalPrice();
        });
    });

    // Handle size selection for drink
    sizeSelect.addEventListener('change', () => {
        const sizePrice = parseInt(sizeSelect.options[sizeSelect.selectedIndex].getAttribute('data-price'));
        selectedDrinkPrice = sizePrice;
        updateTotalPrice();
    });

    // Update total price
    function updateTotalPrice() {
        const total = selectedDrinkPrice + selectedDessertPrice;
        priceDisplay.textContent = `Total: ₱${total}`;
        continueButton.disabled = !drinkInput.value || !dessertInput.value;
    }
</script>

</body>
</html>
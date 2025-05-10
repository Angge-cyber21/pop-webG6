<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "preorder pal");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $drink = $_POST["drink"];
    $size = $_POST["size"];
    $price = $_POST["price"];
    $payment_method = $_POST["payment_method"];

    // Insert the order into the database
    $stmt = $conn->prepare("INSERT INTO drink_orders (drink_name, drink_size, price, payment_method) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $drink, $size, $price, $payment_method);
    $stmt->execute();
    $stmt->close();

    // Redirect the user to payment.php after successful order submission
    header("Location: payment.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Drinks Menu - PreOrder Pal</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Global styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080;
            color: white;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .left {
            display: flex;
            align-items: center;
        }

        .navbar .left img.logo {
            height: 40px;
            width: 40px;
            margin-right: 10px;
        }

        .navbar .left .site-name {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .drink-section {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .drink-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .drink-button {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            text-align: center;
            width: 140px;
            background-color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 10px;
        }

        .drink-button.selected {
            box-shadow: 0 0 15px 3px #004080;
            transform: scale(1.05);
        }

        .drink-button img {
            width: 120px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .drink-button div {
            font-weight: bold;
            font-size: 1.1rem;
            color: #004080;
        }

        label {
            font-weight: bold;
            font-size: 1.1rem;
            color: #004080;
            display: block;
            margin-bottom: 8px;
        }

        select.size-select {
            width: 200px;
            padding: 8px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .price-display {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #004080;
        }

        .continue-button {
            background-color: #004080;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .continue-button:disabled {
            background-color: #7a9cc6;
            cursor: not-allowed;
        }

        .continue-button:hover:not(:disabled) {
            background-color: #003366;
        }

        @media (max-width: 768px) {
            .drink-container {
                gap: 20px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="left">
            <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" alt="Logo" class="logo" />
            <div class="site-name">PreOrder Pal</div>
        </div>
    </nav>

    <section class="drink-section">
        <h1 style="text-align:center; color:#004080; margin-bottom: 30px;">Choose Your Drink</h1>

        <form id="drinkForm" method="POST" action="">
            <input type="hidden" name="drink" id="drinkInput">
            <input type="hidden" name="size" id="sizeInput">
            <input type="hidden" name="price" id="priceInput">
            <input type="hidden" name="payment_method"> <!-- Hidden for payment method -->

            <div class="drink-container" id="drinkContainer">
                <!-- Drink buttons -->
                <div class="drink-button" data-drink="Coke">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/1b/Coca-Cola_logo.svg" alt="Coke" />
                    <div>Coke</div>
                </div>
                <div class="drink-button" data-drink="Royal">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/4a/Royal_Fruit_Soda_logo.svg" alt="Royal" />
                    <div>Royal</div>
                </div>
                <div class="drink-button" data-drink="Sprite">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5f/Sprite_logo.svg" alt="Sprite" />
                    <div>Sprite</div>
                </div>
                <div class="drink-button" data-drink="Mountain Dew">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/1b/Mountain_Dew_logo.svg" alt="Mountain Dew" />
                    <div>Mountain Dew</div>
                </div>
                <div class="drink-button" data-drink="Ice Tea">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3a/Iced_tea_icon.svg" alt="Ice Tea" />
                    <div>Ice Tea</div>
                </div>
            </div>

            <label for="sizeSelect">Select Size:</label>
            <select id="sizeSelect" class="size-select" disabled>
                <option value="" disabled selected>Select size</option>
                <option value="small" data-price="50">Small - ₱50</option>
                <option value="medium" data-price="70">Medium - ₱70</option>
                <option value="large" data-price="90">Large - ₱90</option>
            </select>

            <div class="price-display" id="priceDisplay">Price: ₱0</div>

            <button class="continue-button" id="continueButton" type="button" disabled>Continue</button>
        </form>
    </section>

    <script>
        const drinkButtons = document.querySelectorAll('.drink-button');
        const sizeSelect = document.getElementById('sizeSelect');
        const priceDisplay = document.getElementById('priceDisplay');
        const continueButton = document.getElementById('continueButton');
        const drinkInput = document.getElementById('drinkInput');
        const sizeInput = document.getElementById('sizeInput');
        const priceInput = document.getElementById('priceInput');

        let selectedDrink = null;

        // Add click event listener to each drink button
        drinkButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove selected class from other buttons
                drinkButtons.forEach(btn => btn.classList.remove('selected'));
                // Add selected class to clicked button
                button.classList.add('selected');
                selectedDrink = button.getAttribute('data-drink');
                drinkInput.value = selectedDrink;

                sizeSelect.disabled = false;
                sizeSelect.value = "";
                priceDisplay.textContent = "Price: ₱0";
                continueButton.disabled = true;
                sizeInput.value = "";
                priceInput.value = "";
            });
        });

        sizeSelect.addEventListener('change', () => {
            const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
            const size = selectedOption.value;
            const price = selectedOption.getAttribute('data-price');

            sizeInput.value = size;
            priceInput.value = price;
            priceDisplay.textContent = `Price: ₱${price}`;
            continueButton.disabled = false;
        });

        continueButton.addEventListener('click', (event) => {
            event.preventDefault();

            // Show SweetAlert2 prompt for payment method selection
            Swal.fire({
                title: 'How would you like to pay?',
                text: "Choose to pay online or at the restaurant.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Pay Online',
                cancelButtonText: 'Pay at Restaurant'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user chooses to pay online
                    document.querySelector("input[name='payment_method']").value = "pay_online";
                    document.getElementById('drinkForm').submit(); // Submit form to payment.php
                } else {
                    // If user chooses to pay at restaurant
                    document.querySelector("input[name='payment_method']").value = "pay_at_counter";
                    showOrderSummary();
                }
            });
        });

        function showOrderSummary() {
            const drink = document.getElementById('drinkInput').value;
            const size = document.getElementById('sizeInput').value;
            const price = documen   t.getElementById('priceInput').value;

            Swal.fire({
                title: 'Order Summary',
                text: `Drink: ${drink}\nSize: ${size}\nPrice: ₱${price}`,
                icon: 'info',
                confirmButtonText: 'Okay'
            }).then(() => {
                // Submit the form after showing the order summary
                document.getElementById('drinkForm').submit();
            });
        }
    </script>
</body>
</html>

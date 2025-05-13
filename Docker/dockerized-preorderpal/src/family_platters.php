<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define platter content
$platterContents = [
    'small' => [
        'title' => 'Family Platter Small - ₱1,999 (Good for 6-8 persons)',
        'price' => 1999,
        'items' => [
            '1 pc. Daing na bangus', '1 ord. Chopsuey', '1 ord. Crispy pata',
            '1 pc. Inihaw na Liempo', '1/2 ord. Butch Buttered Chicken',
            '6 pcs. Lumpiang shanghai', '6 pcs. Danggit', '4 pcs. Okra',
            '1 pc. Dessert (Leche Ube)', '7 ord. Rice', '1 ord. Mangga and Kamatis',
            '2 pcs. Boiled Egg', '10 pcs. Kropek', '1 Bot Drinks (Pepsi 1.5)',
            '6 pcs. Busa', '1 pck. Cornick'
        ]
    ],
    'medium' => [
        'title' => 'Family Platter Medium - ₱3,499 (Good for 10-12 persons)',
        'price' => 3499,
        'items' => [
            '1 ord. Crispy pata', '1 whole Butch Buttered Chicken', '2 pcs. Inihaw na Liempo',
            '1 pc. Daing na bangus', '12 pcs. Lumpiang Shanghai', '6 pcs. Okra',
            '1 ord. Mangga at Kamatis', '4 pcs. Boiled egg', '20 pcs. Kropek',
            '10 ord. Rice', '2 pcs. dessert (Leche Ube)', '12 pcs. Danggit',
            '3 bot. Drinks (Pepsi 1.5)', '1 ord. Baked Tahong', '3 Steamed Tilapia',
            '10 pcs. Busa', '2 pck. Cornick'
        ]
    ],
    'large' => [
        'title' => 'Family Platter Large - ₱4,499 (Good for 18-20 persons)',
        'price' => 4499,
        'items' => [
            '1 ord. Crispy pata', '1 whole Butch Buttered Chicken', '32 pcs. Lumpiang shanghai',
            '1 ord. Bangus Ala pobre', '3 pcs. Inihaw na Liempo', '3 pcs. Salted egg',
            '4 pcs. Boiled egg', '1 ord. Mangga at Kamatis', '10 pcs. Okra',
            '30 pcs. Kropek', '1 ord. Baked Tahong', '2 ord. Burong Mangga', '12 pcs. Danggit',
            '4 pcs. Steamed Tilapia', '3 pcs. Dessert (Leche Ube)', '18 ord. Rice',
            '3 bot. Drinks (Pepsi 1.5)', '1 ord. Chopsuey', '12 pcs. Busa', '3 pck. Cornick'
        ]
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['platter'])) {
    $selectedPlatter = $_POST['platter'];
    $_SESSION['selected_platter'] = $selectedPlatter;
    $_SESSION['platter_details'] = $platterContents[$selectedPlatter];
    header('Location: order_summary_butch.php');
    exit();
}

$selectedPlatter = isset($_SESSION['selected_platter']) ? $_SESSION['selected_platter'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="new-logo.png">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Family Platters - PreOrder Pal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        /* Same CSS styles from your original code */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f0f4f8, #e0eafc);
            color: #333;
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, #004080, #0059b3);
            color: white;
            padding: 15px 30px;
            position: sticky;
            top: 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .navbar .left {
            display: flex;
            align-items: center;
        }

        .navbar .left img.logo {
            height: 45px;
            margin-right: 15px;
        }

        .site-name {
            font-size: 1.6rem;
            font-weight: 600;
        }

        .platter-section {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 2.2rem;
            color: #003366;
            margin-bottom: 30px;
        }

        .platter-buttons {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .platter-button {
            border-radius: 20px;
            background: white;
            width: 200px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            cursor: pointer;
            padding: 15px;
        }

        .platter-button.selected,
        .platter-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 80, 200, 0.3);
            border: 2px solid #0059b3;
        }

        .platter-button img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 12px;
        }

        .platter-button div {
            font-weight: 600;
            font-size: 1rem;
            color: #004080;
        }

        .platter-preview {
            background-color: #fff;
            border-radius: 20px;
            padding: 30px;
            max-width: 750px;
            margin: 0 auto 30px;
            text-align: left;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            color: #003366;
        }

        .platter-preview h2 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        .platter-preview ul {
            padding-left: 20px;
            list-style: disc;
        }

        .continue-button {
            background: linear-gradient(90deg, #004080, #0059b3);
            color: white;
            border: none;
            padding: 14px 40px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 10px auto;
            display: block;
            width: fit-content;
        }

        .continue-button:hover:not(:disabled) {
            background: #003366;
            transform: scale(1.05);
        }

        .continue-button:disabled {
            background: #a2b9d3;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="left">
            <img src="new-logo.png" alt="PreOrder Pal Logo" class="logo" />
            <div class="site-name">PreOrder Pal</div>
        </div>
    </nav>

    <section class="platter-section">
        <h1>Family Platters</h1>
        <form method="POST" id="platterForm">
            <div class="platter-buttons" id="platterButtons">
                <?php foreach ($platterContents as $key => $platter): ?>
                    <div class="platter-button <?= ($selectedPlatter === $key) ? 'selected' : ''; ?>" data-platter="<?= $key; ?>">
                        <img src="https://cdn-icons-png.flaticon.com/512/1046/104678<?= $key === 'small' ? '4' : ($key === 'medium' ? '5' : '6'); ?>.png" alt="Family Platter <?= ucfirst($key); ?>" />
                        <div><?= $platter['title'] ?><br>₱<?= number_format($platter['price'], 2); ?></div>
                    </div>
                    <input type="radio" name="platter" value="<?= $key; ?>" <?= ($selectedPlatter === $key) ? 'checked' : ''; ?> style="display: none;">
                <?php endforeach; ?>
            </div>

            <div class="platter-preview" id="platterPreview">
                <?php if ($selectedPlatter): ?>
                    <h2><?= $platterContents[$selectedPlatter]['title']; ?></h2>
                    <ul>
                        <?php foreach ($platterContents[$selectedPlatter]['items'] as $item): ?>
                            <li><?= $item; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <h2>Select a platter to see the contents</h2>
                <?php endif; ?>
            </div>

            <button type="submit" class="continue-button" id="continueButton" <?= !$selectedPlatter ? 'disabled' : ''; ?>>Continue</button>
        </form>

        <button type="button" class="continue-button" onclick="window.location.href='choose_restaurant.php'">Go Back</button>
    </section>

    <script>
        const platterButtons = document.querySelectorAll('.platter-button');
        const continueButton = document.getElementById('continueButton');
        const platterContents = <?= json_encode($platterContents); ?>;

        platterButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = document.getElementById('platterForm');
                const platter = button.getAttribute('data-platter');
                const input = form.querySelector(`input[value="${platter}"]`);
                form.querySelectorAll('.platter-button').forEach(b => b.classList.remove('selected'));
                button.classList.add('selected');
                input.checked = true;

                document.getElementById('platterPreview').innerHTML = `
                    <h2>${platterContents[platter].title}</h2>
                    <ul>${platterContents[platter].items.map(item => '<li>' + item + '</li>').join('')}</ul>
                `;
                continueButton.disabled = false;
            });
        });
    </script>
</body>
</html>

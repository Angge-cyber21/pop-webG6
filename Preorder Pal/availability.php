<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Restaurant</title>
    <style>
        body {
            background: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
            text-align: center;
        }

        h1 {
            color: #004080;
        }

        .restaurant-options {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
        }

        .restaurant-card {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 220px;
            transition: transform 0.3s;
            text-decoration: none;
            color: #333;
        }

        .restaurant-card:hover {
            transform: scale(1.05);
            background-color: #e9f5ff;
        }

        .restaurant-card h2 {
            margin-bottom: 10px;
            color: #007bff;
        }
    </style>
</head>
<body>

<h1>Select a Restaurant to View Availability</h1>

<div class="restaurant-options">
    <a href="table_availability.php?restaurant=Wanam%20sa%20Bukid" class="restaurant-card">
        <h2>Wanam sa Bukid</h2>
        <p>View table availability</p>
    </a>

    <a href="table_availability.php?restaurant=Butch" class="restaurant-card">
        <h2>Butch</h2>
        <p>View table availability</p>
    </a>
</div>

</body>
</html>

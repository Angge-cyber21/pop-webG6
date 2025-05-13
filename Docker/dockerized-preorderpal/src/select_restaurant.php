<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Restaurant</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 40px;
        }

        button {
            padding: 15px 25px;
            margin: 10px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .available {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Select Your Preferred Restaurant</h2>
    <div id="restaurant-options"></div>

    <script>
        const availability = JSON.parse(localStorage.getItem('reservationAvailability'));
        const container = document.getElementById('restaurant-options');

        for (const [name, isAvailable] of Object.entries(availability)) {
            const btn = document.createElement('button');
            btn.textContent = `${name} - ${isAvailable ? 'Available' : 'Fully Booked'}`;
            btn.disabled = !isAvailable;
            if (isAvailable) btn.className = "available";
            btn.onclick = () => {
                localStorage.setItem('chosenRestaurant', name);
                window.location.href = 'finalize_reservation.php';
            };
            container.appendChild(btn);
        }
    </script>
</body>
</html>

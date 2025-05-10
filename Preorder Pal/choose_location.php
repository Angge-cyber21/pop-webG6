<?php
session_start();
require_once 'db.php'; // Include the DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['reservations'] = $_POST;

    // Loop through tables (max 3)
    for ($i = 1; $i <= 3; $i++) {
        if (empty($_POST["date$i"]) || empty($_POST["time$i"])) continue;

        $date = $_POST["date$i"];
        $time = $_POST["time$i"];
        $people = $_POST["people$i"];
        $location = $_POST["location$i"];

        // Insert into DB
        $stmt = $pdo->prepare("INSERT INTO reservations (table_number, reservation_date, reservation_time, number_of_people, location) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$i, $date, $time, $people, $location]);
    }

    echo "<script>window.location.href='table_availability.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="preorder-pal-logo.png">
    <meta charset="UTF-8" />
    <title>PreOrder Pal - Table Reservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #004080;
            --accent: #28a745;
            --highlight: #007bff;
            --light-bg: #f4f4f4;
            --white: #fff;
            --shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
        }

        header, footer {
            background-color: var(--primary);
            color: var(--white);
            text-align: center;
            padding: 20px;
        }

        main {
            flex: 1;
            padding: 30px 20px;
            max-width: 700px;
            margin: auto;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table-form {
            background-color: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .table-form:hover {
            transform: scale(1.01);
        }

        .table-form h3 {
            margin-bottom: 10px;
            color: var(--primary);
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        .add-btn, .confirm-btn {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-btn {
            background-color: var(--highlight);
            color: var(--white);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .add-btn:hover {
            background-color: #0056b3;
        }

        .confirm-btn {
            background-color: var(--accent);
            color: var(--white);
            width: 100%;
        }

        .confirm-btn:hover {
            background-color: #218838;
        }

        @media (max-width: 600px) {
            input, select {
                font-size: 0.95rem;
            }

            .add-btn, .confirm-btn {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

<header>🪑 Reserve Your Table</header>

<main>
    <form id="reservation-form" method="POST">
        <div id="reservation-container">
            <div class="table-form" data-table="1">
                <h3>Table 1</h3>
                <input type="date" name="date1" required />
                <input type="time" name="time1" required />
                <select name="people1" required>
                    <?php for ($j = 1; $j <= 10; $j++): ?>
                        <option value="<?= $j ?>"><?= $j ?> <?= $j == 1 ? "person" : "people" ?></option>
                    <?php endfor; ?>
                </select>
                <select name="location1" required>
                    <option value="balcony">Balcony</option>
                    <option value="dining-room">Dining Room</option>
                    <option value="outside">Outside</option>
                </select>
            </div>
        </div>

        <button type="button" class="add-btn" id="add-table-btn">➕ Add Table</button>
        <button type="submit" class="confirm-btn">✅ Confirm Reservation</button>
    </form>
</main>

<footer>&copy; 2025 PreOrder Pal. All rights reserved.</footer>

<script>
    let tableCount = 1;

    document.getElementById("add-table-btn").addEventListener("click", () => {
        if (tableCount >= 3) {
            Swal.fire("Limit Reached", "You can only reserve up to 3 tables.", "warning");
            return;
        }

        tableCount++;
        const newTable = document.createElement("div");
        newTable.className = "table-form";
        newTable.setAttribute("data-table", tableCount);
        newTable.innerHTML = `
            <h3>Table ${tableCount}</h3>
            <input type="date" name="date${tableCount}" required />
            <input type="time" name="time${tableCount}" required />
            <select name="people${tableCount}" required>
                ${[...Array(10).keys()].map(i => `<option value="${i + 1}">${i + 1} ${i + 1 === 1 ? "person" : "people"}</option>`).join("")}
            </select>
            <select name="location${tableCount}" required>
                <option value="balcony">Balcony</option>
                <option value="dining-room">Dining Room</option>
                <option value="outside">Outside</option>
            </select>
        `;
        document.getElementById("reservation-container").appendChild(newTable);
    });

    document.getElementById("reservation-form").addEventListener("submit", function (e) {
        e.preventDefault();
        const data = new FormData(this);
        let summary = "";

        for (let i = 1; i <= tableCount; i++) {
            const date = data.get(`date${i}`);
            const time = data.get(`time${i}`);
            const people = data.get(`people${i}`);
            const location = data.get(`location${i}`);
            summary += `Table ${i}: <b>${date}</b> at <b>${time}</b> for <b>${people}</b> in <b>${location}</b><br>`;
        }

        Swal.fire({
            title: "Confirm Reservation",
            icon: "info",
            html: summary,
            showCancelButton: true,
            confirmButtonText: "Yes, continue",
            cancelButtonText: "Review again",
            confirmButtonColor: "#28a745"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>

</body>
</html>

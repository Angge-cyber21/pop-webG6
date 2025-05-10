<?php
session_start();
require_once 'db.php';

echo "<script>
const reservationData = JSON.parse(localStorage.getItem('pendingReservationData'));
const restaurant = localStorage.getItem('chosenRestaurant');

fetch('', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({reservationData, restaurant})
}).then(() => {
    window.location.href = 'foods_drinks.php';
});
</script>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $data = $input['reservationData'];
    $restaurant = $input['restaurant'];

    for ($i = 1; $i <= 3; $i++) {
        if (empty($data["date$i"]) || empty($data["time$i"])) continue;

        $date = $data["date$i"];
        $time = $data["time$i"];
        $people = $data["people$i"];
        $location = $data["location$i"];

        $stmt = $pdo->prepare("INSERT INTO reservations (table_number, reservation_date, reservation_time, number_of_people, location, restaurant_name)
                               VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$i, $date, $time, $people, $location, $restaurant]);
    }

    exit();
}
?>

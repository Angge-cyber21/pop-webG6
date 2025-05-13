<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['selected_restaurant'])) {
    $_SESSION['selected_restaurant'] = $_POST['selected_restaurant'];
    $_SESSION['restaurant_selected'] = true;
    $_SESSION['restaurant_name'] = $_POST['selected_restaurant'];
}
?>
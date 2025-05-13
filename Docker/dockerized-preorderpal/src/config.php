<?php
$host = 'localhost';
$dbname = 'restaurant_db';
$username = 'root';
$password = 'Mayyra21aaaAngge';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
<?php
// Database connection details using MySQLi (for $conn)
$servername = "localhost";      // Database host (usually 'localhost' if you're using a local server)
$username = "root";             // MySQL username
$password = "Mayyra21aaaAngge";                 // MySQL password (default is an empty string for XAMPP or WAMP)
$dbname = "preorder_pal";       // Database name (change this to the name of your database)

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Database connection details using PDO (for $pdo)
$host = 'localhost';              // Your database host
$db   = 'preorder_pal';           // The name of your database (no spaces)
$user = 'root';                   // Your database username
$pass = 'Mayyra21aaaAngge';                       // Your database password (empty for WAMP)
$charset = 'utf8mb4';             // Character set

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options for better error handling and security
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                   // Use real prepared statements
];

try {
    // Create PDO connection
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>

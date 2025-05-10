<?php
// Database configuration
$host = 'localhost';        // Your database host (e.g., localhost or IP)
$db   = 'preorder pal';     // The name of your database
$user = 'root';             // Your database username
$pass = '';                 // Your database password (leave empty if none)
$charset = 'utf8mb4';       // The character set (utf8mb4 is recommended)

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // Data Source Name

// PDO options for better error handling
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Enable exception on error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                    // Use real prepared statements
];

try {
    // Establish database connection
    $pdo = new PDO($dsn, $user, $pass, $options);
    // If the connection is successful, PDO object is created
} catch (\PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Ensure the tables exist in your database (you can create tables manually or through code)
// Example table creation script for restaurant_tables

/*
CREATE TABLE IF NOT EXISTS restaurant_tables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_name VARCHAR(255) NOT NULL,
    table_number INT NOT NULL,
    is_available BOOLEAN DEFAULT 1,  // 1 means available, 0 means reserved/unavailable
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (restaurant_name, table_number)  // Ensures no duplicate tables
);
*/

?>

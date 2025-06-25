<?php
// Example Database Configuration
// Copy this file to database.php and update with your credentials

// Enable error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
$host = 'localhost';                    // Usually 'localhost' for shared hosting
$dbname = 'your_database_name';         // Your MySQL database name
$username = 'your_database_username';   // Your MySQL username
$password = 'your_database_password';   // Your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// For production, disable error reporting:
// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);
// error_reporting(0);
?>
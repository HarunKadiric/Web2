<?php
$host = 'localhost';
$dbname = 'projectdatab';     // Replace with your actual DB name
$username = 'root';     // Replace with your DB username (e.g., root)
$password = 'root';     // Replace with your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database connected successfully.";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

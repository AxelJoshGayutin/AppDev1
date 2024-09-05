<?php
$host = 'localhost'; // Database host
$dbname = 'appdevact1'; // Database name
$user = 'root'; // Database username (adjust if necessary)
$pass = ''; // Database password (adjust if necessary)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>

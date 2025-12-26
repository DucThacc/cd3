<?php
// config.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$host = 'db'; // Tên service trong docker-compose
$db   = 'demo_db';
$user = 'user';
$pass = 'password';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8mb4");
?>

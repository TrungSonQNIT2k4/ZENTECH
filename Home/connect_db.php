<?php
$host = 'localhost';
$dbname = 'zentech';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=localhost;dbname=zentech", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Kết nối CSDL thất bại: " . $e->getMessage());
}
?>
    
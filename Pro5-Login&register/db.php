<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=database", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Kết nối CSDL thất bại: " . $e->getMessage());
}
?>
    
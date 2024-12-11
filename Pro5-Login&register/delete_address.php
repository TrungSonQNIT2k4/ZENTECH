<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$address_id = $_GET['id'] ?? null;

if ($address_id) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("DELETE FROM addresses WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $address_id, 'user_id' => $_SESSION['user_id']]);
}

echo "<script>alert('Địa chỉ đã được xóa!'); window.location='list_addresses.php';</script>";
exit;
?>

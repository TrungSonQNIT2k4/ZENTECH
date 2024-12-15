<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Lấy danh sách địa chỉ từ cơ sở dữ liệu
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM addresses WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Pro5-Login&register/assets/list_addresses.css">
    <link rel="stylesheet" href="../Pro5-Login&register/assets/profile.css">
<<<<<<< HEAD
    <link rel="stylesheet" href="/css/order_all.css">
=======
>>>>>>> 3ba52c8682aa240ccff5915cfefdd2cc72327173
    <title>Danh Sách Địa Chỉ</title>
</head>
<body>
    <?php include 'templates/sidebar.php'; ?>

    <section class="main-content">
        <h1>Danh Sách Địa Chỉ</h1>
        <?php if (empty($addresses)): ?>
            <p>Chưa có địa chỉ nào được lưu.</p>
        <?php else: ?>
            <div class="addresses-container">
                <?php foreach ($addresses as $address): ?>
                    <div class="address-card">
                        <h2><?= htmlspecialchars($address['name']); ?></h2>
                        <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($address['phone']); ?></p>
                        <p><strong>Loại địa chỉ:</strong> <?= htmlspecialchars($address['address_type']); ?></p>
                        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($address['specific_address']) . ", " . htmlspecialchars($address['ward']) . ", " . htmlspecialchars($address['district']) . ", " . htmlspecialchars($address['province']); ?></p>
                        <div class="button-group">
                            <a href="edit_address.php?id=<?= $address['id']; ?>" class="btn-edit">Chỉnh Sửa</a>
                            <a href="delete_address.php?id=<?= $address['id']; ?>" class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này?');">Xóa</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</body>
</html>

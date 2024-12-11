<?php
require 'db.php';

// Lấy thông tin người dùng từ CSDL
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT firstname, lastname, profile_image FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();

// Kiểm tra xem người dùng có ảnh đại diện không
$profile_image = !empty($user['profile_image']) && file_exists('uploads/' . $user['profile_image']) ? 'uploads/' . $user['profile_image'] : 'uploads/default.jpg'; // Kiểm tra xem ảnh có tồn tại không
?>

<div class="sidebar">
    <div class="user-info">
        <!-- Hiển thị ảnh đại diện hoặc ảnh mặc định -->
        <img src="<?= htmlspecialchars($profile_image) ?>" alt="Ảnh đại diện" width="100" height="100" style="border-radius: 50%; object-fit: cover;">

        <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?>
    </div>
    <hr>
    <ul>
        <li><a href="index.php">Hồ sơ</a></li>
        <li><a href="add_address.php">Thêm Địa chỉ</a></li>
        <li><a href="list_addresses.php">Danh sách Địa chỉ</a></li>
        <li><a href="change_password.php">Đổi mật khẩu</a></li>
        <li><a href="logout.php">Đăng xuất</a></li>
    </ul>
</div>

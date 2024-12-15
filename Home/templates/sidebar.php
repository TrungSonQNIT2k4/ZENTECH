<?php
require 'connect_db.php';

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
        
        <div class="nav_bill_user_info_p">
            <p><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></p>
            <a href="/Home/index.php"><p class="fix_info"> Sửa hồ sơ</p></a>
        </div>
    </div>
    <hr>
    <ul>
        <div class="nav_bill_link">
            <a href="/Home/index.php">Hồ sơ</a>
            <a href="/Home/add_address.php">Thêm Địa chỉ</a>
            <a href="/Home/list_addresses.php">Danh sách Địa chỉ</a>
            <a href="/Home/change_password.php">Đổi mật khẩu</a>
            <a href="/Home/logout.php">Đăng xuất</a>
            <a href="/Home/order_all.php"> Đơn Mua</a>
        </div>
    </ul>
</div>

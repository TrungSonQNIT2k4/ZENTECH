<?php
session_start();
require 'db.php';

// Kiểm tra người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Bật chế độ lỗi PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Lấy thông tin người dùng từ CSDL
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT firstname, lastname, email, phone, address FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Không tìm thấy thông tin người dùng.";
    exit;
}

// Debug dữ liệu người dùng
// echo '<pre>'; print_r($user); echo '</pre>'; exit;

// Xử lý giá trị mặc định
$firstname = $user['firstname'] ?? 'Chưa có thông tin';
$lastname = $user['lastname'] ?? 'Chưa có thông tin';
$email = $user['email'] ?? 'Chưa có thông tin';
$phone = $user['phone'] ?? 'Chưa có thông tin';
$address = $user['address'] ?? 'Chưa có thông tin';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Pro5-Login&register/assets/profile.css">
    <title>Hồ Sơ</title>
</head>
<body>
    <?php include 'templates/sidebar.php'; ?>
    
    <section class="main-content">
        <!-- Hiển thị thông báo nếu có -->
        <h1 class="tiltle">Hồ Sơ</h1>
        
        <form method="POST" action="edit_profile.php" class="form" enctype="multipart/form-data">
            <div class="just-form">
                <div class="input-container">    
                    <label>Họ:</label>
                    <input type="text" name="first_name" value="<?= htmlspecialchars($firstname) ?>" required><br>
                </div>
                <div class="input-container">   
                    <label>Tên:</label>
                    <input type="text" name="last_name" value="<?= htmlspecialchars($lastname) ?>" required><br>
                </div>
                <div class="input-container">   
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br>
                </div>
                <div class="input-container">   
                    <label>Số Điện Thoại:</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>" required><br>
                </div>
                <div class="input-container">
                    <label for="profile_image">Cập nhật ảnh hồ sơ:</label>
                    <input type="file" name="profile_image" id="profile_image" accept="image/*"><br>
                </div>
                <div class="input-container">   
                    <label>Địa Chỉ Cụ Thể:</label>
                    <textarea name="address" required><?= htmlspecialchars($address) ?></textarea><br>
                </div>
                
            </div>    
            <div class="full-width">
                <div class="button-container">
                    <button type="submit">Cập Nhật</button>
                </div>
            </div>

        </form>

    </section>
</body>
</html>

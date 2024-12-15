<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT password FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Không tìm thấy thông tin người dùng.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_password = trim($_POST['old_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Kiểm tra mật khẩu cũ
    if (!password_verify($old_password, $user['password'])) {
        $_SESSION['error'] = "Mật khẩu cũ không đúng.";
        header("Location: change_password.php");
        exit;
    }

    // Kiểm tra mật khẩu mới và xác nhận
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Mật khẩu nhập lại không trùng khớp.";
        header("Location: change_password.php");
        exit;
    }

    // Kiểm tra độ dài và yêu cầu của mật khẩu mới
    if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{7,}$/', $new_password)) {
        $_SESSION['error'] = "Mật khẩu phải bao gồm ít nhất 7 ký tự, 1 chữ cái và 1 số.";
        header("Location: change_password.php");
        exit;
    }

    // Mã hóa mật khẩu mới và cập nhật
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
    $stmt->execute([
        'password' => $hashed_password,
        'id' => $user_id
    ]);

    echo "<script>alert('Cập nhật mật khẩu thành công!'); window.location='login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Pro5-Login&register/assets/profile.css">
    <link rel="stylesheet" href="/css/order_all.css">
    <title>Thay Đổi Mật Khẩu</title>
</head>
<body>
    <div class="profile-container">
        <?php include 'templates/sidebar.php'; ?>
    
        <section class="main-content">
            <h1>Thay Đổi Mật Khẩu</h1>
    
            <!-- Hiển thị thông báo lỗi hoặc thành công -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php elseif (isset($_SESSION['message'])): ?>
                <div class="success-message">
                    <?= $_SESSION['message']; ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
    
            <form method="POST" action="change_password.php" class="form">
                <div class="input-container">
                    <label>Mật khẩu cũ:</label>
                    <input type="password" name="old_password" required><br>
                </div>
                <div class="input-container">
                    <label>Mật khẩu mới:</label>
                    <input type="password" name="new_password" required><br>
                </div>
                <div class="input-container">
                    <label>Xác nhận mật khẩu mới:</label>
                    <input type="password" name="confirm_password" required><br>
                </div>
    
                <div class="full-width">
                    <div class="button-container">
                        <button type="submit">Cập Nhật Mật Khẩu</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>

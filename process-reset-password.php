<?php

// Kiểm tra có token không
if (!isset($_POST['token'])) {
    die("Token not found.");
}

$token = $_POST["token"];
$new_password = $_POST["new_password"];
$confirm_password = $_POST["confirm_password"];

$token_hash = hash("sha256", $token);

require_once 'db.php';

// Kiểm tra token trong cơ sở dữ liệu
$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token_hash = :token_hash");
$stmt->bindValue(':token_hash', $token_hash, PDO::PARAM_STR);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user == false) {
    header("Location: reset-password.php?token=$token&error=Token not found");
    exit;
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    header("Location: reset-password.php?token=$token&error=Token has expired");
    exit;
}

// Kiểm tra mật khẩu mới và mật khẩu xác nhận có khớp không
if ($new_password !== $confirm_password) {
    echo "<script>
        alert('Mật khẩu nhập lại không khớp');
        window.location.href = 'reset-password.php?token=$token'
    </script>";
    exit;
}

// Kiểm tra độ dài mật khẩu mới (phải có ít nhất 7 ký tự, 1 chữ cái và 1 số)
if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{7,}$/', $new_password)) {
    echo "<script>
        alert('Mật khẩu phải bao gồm ít nhất 7 ký tự, 1 chữ cái và 1 số');
        window.location.href = 'reset-password.php?token=$token';
    </script>";
    exit;
}


// Mã hóa mật khẩu mới
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Cập nhật mật khẩu mới vào cơ sở dữ liệu
$stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
$stmt->execute([
    'password' => $hashed_password,
    'id' => $user['id']
]);

// Xóa reset token sau khi thay đổi mật khẩu để bảo mật
$stmt = $pdo->prepare("UPDATE users SET reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = :id");
$stmt->execute(['id' => $user['id']]);

// Chuyển hướng tới trang đăng nhập với thông báo thành công
echo "<script>alert('Đặt lại mật khẩu thành công!'); window.location='login.php';</script>";
exit;

?>

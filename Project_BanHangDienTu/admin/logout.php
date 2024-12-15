<?php
session_start();
unset($_SESSION['current_user']); // Xóa thông tin đăng nhập khỏi session
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <title>Đăng xuất tài khoản</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/admin_style.css">
    </head>
    <body>
        <script>
            // Hiển thị thông báo và chuyển hướng
            alert('Đăng xuất tài khoản thành công!');
            window.location.href = './index.php'; // Chuyển hướng về trang đăng nhập
        </script>
    </body>
</html>

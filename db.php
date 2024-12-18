<?php
// Cấu hình kết nối cơ sở dữ liệu
$host = 'localhost'; // Hoặc tên máy chủ của bạn
$dbname = 'zentech'; // Tên cơ sở dữ liệu của bạn
$username = 'root';  // Tên người dùng
$password = '';      // Mật khẩu của bạn

try {
    // Tạo đối tượng PDO để kết nối
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Thiết lập chế độ lỗi của PDO để ném ra ngoại lệ khi có lỗi
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Nếu kết nối không thành công, hiển thị lỗi
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}
?>

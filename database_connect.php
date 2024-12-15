<?php
// Tạo một hàm kết nối cơ sở dữ liệu để sử dụng lại
function connectDatabase() {
    $conn = new mysqli("localhost", "root", "", "zentech");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}
?>
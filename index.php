<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZENTECH</title>
    <link rel="stylesheet" href="/ZENTECH/style.css">
    <link rel="icon" type="image/png" href="/ZENTECH/Data/Image/ICONLOGOZ.png" />
    <link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
</head>

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

<?php
include 'headerA.php';
?>

<?php
include 'container.php';
?>

<?php
include 'footer.php';
?>
</html>


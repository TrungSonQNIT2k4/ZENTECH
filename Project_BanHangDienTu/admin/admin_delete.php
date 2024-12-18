
<?php
include 'header.php';
include 'connect_db.php'; // Kết nối đến cơ sở dữ liệu

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!empty($_SESSION['current_user'])) {
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];

        // Xóa admin khỏi cơ sở dữ liệu
        $stmt = $con->prepare("DELETE FROM `admin` WHERE `admin_id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        header("Location: admin_listing.php"); // Chuyển hướng về danh sách admin
        exit;
    }
}
include 'footer.php';
?>

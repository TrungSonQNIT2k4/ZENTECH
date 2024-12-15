<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/ZENTECH/Data/Image/ICONLOGOZ.png">
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css" > <!-- Kết nối file CSS cho giao diện admin -->
        <script src="../resources/ckeditor/ckeditor.js"></script> <!-- Kết nối CKEditor cho soạn thảo nội dung -->
    </head>
    <body>
        <?php
        session_start(); // Khởi động phiên làm việc
        include '../connect_db.php'; // Bao gồm file kết nối cơ sở dữ liệu
        include '../function.php'; // Bao gồm các hàm tiện ích
        if (!empty($_SESSION['current_user'])) { // Kiểm tra xem đã đăng nhập chưa?
            ?>
            <div id="admin-heading-panel"> <!-- Phần đầu trang quản trị -->
                <div class="header-admin">
                    <div class="left-panel">
                        Xin chào <span>Admin</span> <!-- Hiển thị tên người dùng -->
                    </div>
                    <div class="right-panel">
                        <img height="24" src="../icon/home.png" /> <!-- Biểu tượng trang chủ -->
                        <a href="../admin/index.php">Trang chủ</a> <!-- Liên kết đến trang chủ admin -->
                        <img height="24" src="../icon/logout.png" /> <!-- Biểu tượng đăng xuất -->
                        <a href="logout.php">Đăng xuất</a> <!-- Liên kết đăng xuất -->
                    </div>
                </div>
            </div>
            <div id="content-wrapper"> <!-- Bắt đầu phần nội dung chính -->
                <div class="container-admin">
                    <div class="left-menu"> <!-- Menu bên trái -->
                        <div class="menu-heading">Admin Menu</div> <!-- Tiêu đề menu -->
                        <div class="menu-items">
                            <ul>
                                <li><a href="admin_listing.php">Quản lý Admin</a></li> <!-- Liên kết đến quản lý admin -->
                                <li><a href="product_listing.php">Quản lý sản phẩm</a></li> <!-- Liên kết đến quản lý sản phẩm -->
                                <li><a href="#">Đơn hàng</a></li> <!-- Liên kết đến quản lý đơn hàng (chưa có trang) -->
                            </ul>
                        </div>
                    </div>
                <?php } ?>

<?php
session_start();
require 'connect_db.php';

// Kiểm tra người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("/login.php");
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
    <title>zentech.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/order_all.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/css/order_return.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/order_detail_ship.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
<?php include ("/ZENTECH/headerA.php") ?>
<?php include 'templates/sidebar.php'; ?>
        <div class="content_detail_ship">
            <div class="content_info">
                <div class="content_user">
                    <p class="content_title">Địa chỉ nhận hàng</p>
                    <div class="info_user">
                        <p class="content_name">Nguyễn Thị Bảo Trân</p>
                        <p class="content_number_phone">0964860022</p>
                        <p class="content_address">27 Nguyễn Văn Hiển, phường Nguyễn Văn Cừ, thành phố Quy Nhơn</p>
                    </div>
                </div>

                <div class="content_ship">
                    <ul class="ship_time">
                        <li>07:39 06-12-2024</li>
                        <li>17:42 05-12-2024</li>
                    </ul>

                    <ul class="ship_address">
                        <li>Đang được chuẩn bị: Người gửi đang chuẩn bị hàng</li>
                        <li>Đặt hàng thành công: Đơn hàng đã được đặt</li>
                    </ul>
                </div>
            </div>
            <div class="content_bill_product">
                <div class="content_product">
                    <div class="content_product_nav">
                        <img src="/img/Screenshot 2024-11-28 153840.png" alt="dien thoai">
                        <div class="content_product_info">
                            <p class="name_product">Iphone 16 promax</p>
                            <p class="type_product">Phân loại hàng: màu đen</p>
                            <p class="number_product">x1</p>
                        </div>
                    </div>
                    <p class="money">33.500.000</p>
                </div>
                <hr>
                <div class="content_detail_bill">
                    <div class="content_detail_title">
                        <p class="choice_pay_title">Phương thức thanh toán:</p>
                        <p class="ship_money">Phí vận chuyển:</p>
                        <p class="product_money">Tiền hàng:</p>
                        <p class="sum_money">Tổng tiền:</p>
                    </div>
                    <div class="content_detail_reply">
                        <p class="choice_pay_reply">Thanh toán khi nhận hàng</p>
                        <p class="ship_money_reply">30.000</p>
                        <p class="product_money_reply">33.500.000</p>
                        <p class="sum_money">33.530.000</p>
                    </div>
                </div>
            </div>
            <?php include("/ZENTECH/Home/footer.php") ?>
</body>

</html>
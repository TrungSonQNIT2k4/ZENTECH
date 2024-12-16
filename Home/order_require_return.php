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
        <title>zentech.com</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="/css/order_require_return.css">
        <link rel="stylesheet" href="/css/order_all.css">
        <link rel="stylesheet" href="/style.css">
        <link rel="stylesheet" href="/css/order_return.css">
        <link rel="stylesheet" href="/css/profile.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
    </head>
    <body>
    <?php include ("/ZENTECH/headerA.php") ?>
    <?php include 'templates/sidebar.php'; ?>
           <div class="content">
                        <div class="content_bill_product">
                            <div class="title">
                                <p class="title_require">Đã yêu cầu trả hàng/hoàn tiền </p>
                                <p class="title_require_time"> vào lúc 22:11 ngày 19/11/2024</p>
                            </div>
                            <hr>
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
                                <div class="content_detail">
                                    <div class="content_detail_title">
                                        <p class="require_title">Yêu cầu bởi:</p>
                                        <p class="choice_pay_title">Phương thức thanh toán:</p>
                                        <p class="reason_require_title">Lý do:</p>
                                        <p class="reason_require_title">Tình trạng:</p>
                                    </div>
                                    <div class="content_detail_reason">
                                    <p class="require_reason">Người mua</p>
                                    <p class="choice_pay_reason">Thanh toán khi nhận hàng</p>
                                    <p class="reason_require_reason">Tôi đã nhận được hàng nhưng có vấn đề (bể vỡ, sai mẫu, hàng lỗi, khác mô tả...)</p>
                                    <p>Đang xử lý yêu cầu, vui lòng cung cấp thêm thông tin, hình ảnh xác thực của sản phẩm</p>
                                    <form action="/" method="POST" enctype="multipart/form-data">
                                        <label for="info_Upload">Cung cấp thêm thông tin:</label>
                                        <textarea id="info_Upload" name="info" rows="2" cols="25" placeholder="Nhập thêm thông tin"></textarea>
                                        <label for="imgUpload">Chọn hình ảnh:</label>
                                        <input type="file" id="imgUpload" name="img" accept="image/*">
                                        <button class="button_Upload" type="submit">Tải lên</button>
                                    </form>
                                    </div>
                                </div>
                    </div>
        <?php include ("/ZENTECH/Home/footer.php") ?>
        </div>
        </div>
    </body>
</html>

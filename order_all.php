<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

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
    <link rel="stylesheet" href="/ZENTECH/css/order_all.css">
    <link rel="stylesheet" href="/ZENTECH/style.css">
    <link rel="stylesheet" href="/ZENTECH/css/order_return.css">
    <link rel="stylesheet" href="/ZENTECH/css/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
</head>
<body>
<?php include ("headerA.php") ?>
        <?php include 'templates/sidebar.php'; ?>
            <div class="content">
                <div class="menu_link">
                    <ul class="menu_link_content">
                        <li> <a href="order_all.php">Tất cả</a></li>
                        <li> <a href="order_pay.php">Chờ thanh toán</a></li>
                        <li> <a href="order_transport.php">Vận chuyển</a></li>
                        <li><a href="order_ship.php">Chờ giao hàng</a></li>
                        <li> <a href="order_complete.php">Hoàn thành</a></li>
                        <li> <a href="order_cancel.php">Đã hủy</a></li>
                        <li> <a href="order_return.php">Trả hàng/Hoàn tiền</a></li>
                    </ul>
                </div>
                <div class="content_search">
                        <button class="search_button"><img src="img/search_icon.png" alt="" class="search_icon"></button>
                        <input type="text" id="name" name="name" placeholder="Bạn có thể tìm kiếm theo tên sản phẩm..." class="search_input" spellcheck="false">
                </div>
                <div class="content_bill_product">
                    <div class="content_cancel"><p>Chờ thanh toán</p></div>
                    <hr>
                    <div class="content_product">
                        <div class="content_product_nav">
                            <img src="img/Screenshot 2024-11-28 153840.png" alt="dien thoai">
                            <div class="content_product_info">
                                <p class="name_product">Iphone 16 promax</p>
                                <p class="type_product">Phân loại hàng: màu đen</p>
                                <p class="number_product">x1</p>
                            </div>
                        </div>
                        <p class="money">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_total">
                        <p class="content_total_p">Thành tiền: </p>
                        <p class="money_total">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_info_cancel">
                        <p>Chờ thanh toán</p>
                        <div class="content_button">
                            <button onclick="cancelOrder()"><p>Hủy đơn</p></button>
                            <button><a href="/Home/pay_product.php"><p>Thanh toán</p></a></button>
                        </div>
                    </div>
                    <script src="/Javascript.js/cancel_order.js"></script>
                </div>
                <div class="content_bill_product">
                    <div class="content_cancel"><p>Đã hủy</p></div>
                    <hr>
                    <div class="content_product">
                        <div class="content_product_nav">
                            <img src="img/Screenshot 2024-11-28 153840.png" alt="dien thoai">
                            <div class="content_product_info">
                                <p class="name_product">Iphone 16 promax</p>
                                <p class="type_product">Phân loại hàng: màu đen</p>
                                <p class="number_product">x1</p>
                            </div>
                        </div>
                        <p class="money">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_total">
                        <p class="content_total_p">Thành tiền: </p>
                        <p class="money_total">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_info_cancel">
                        <p>Đã hủy bởi bạn</p>
                        <div class="content_button">
                            <button><a href="..."><p>Mua Lại</p></a></button>
                            <button><a href="/Home/order_detail_cancel.php"><p>Xem chi tiết hủy đơn</p></a></button>
                        </div>
                    </div>
                </div>
                <div class="content_bill_product">
                    <div class="content_cancel"><p>Đang vận chuyển</p></div>
                    <hr>
                    <div class="content_product">
                        <div class="content_product_nav">
                            <img src="img/Screenshot 2024-11-28 153840.png" alt="dien thoai">
                            <div class="content_product_info">
                                <p class="name_product">Iphone 16 promax</p>
                                <p class="type_product">Phân loại hàng: màu đen</p>
                                <p class="number_product">x1</p>
                            </div>
                        </div>
                        <p class="money">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_total">
                        <p class="content_total_p">Thành tiền: </p>
                        <p class="money_total">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_info_cancel">
                        <p>Đang vận chuyển</p>
                        <div class="content_button">
                            <button><a onclick="cancelOrder()"><p>Hủy đơn</p></a></button>
                            <button><a href="/Home/order_detail_ship.php"><p>Xem chi tiết đơn hàng</p></a></button>
                        </div>
                    </div>
                </div>
                <div class="content_bill_product">
                    <div class="content_cancel"><p>Chờ giao hàng</p></div>
                    <hr>
                    <div class="content_product">
                        <div class="content_product_nav">
                            <img src="img/Screenshot 2024-11-28 153840.png" alt="dien thoai">
                            <div class="content_product_info">
                                <p class="name_product">Iphone 16 promax</p>
                                <p class="type_product">Phân loại hàng: màu đen</p>
                                <p class="number_product">x1</p>
                            </div>
                        </div>
                        <p class="money">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_total">
                        <p class="content_total_p">Thành tiền: </p>
                        <p class="money_total">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_info_cancel">
                        <p>Đang chờ giao hàng</p>
                        <div class="content_button">
                            <button><a href="/Home/order_detail_ship.php"><p>Xem chi tiết đơn hàng</p></a></button>
                        </div>
                    </div>
                </div>
                <div class="content_bill_product">
                    <div class="content_cancel"><p>Giao hàng thành công</p></div>
                    <hr>
                    <div class="content_product">
                        <div class="content_product_nav">
                            <img src="img/Screenshot 2024-11-28 153840.png" alt="dien thoai">
                            <div class="content_product_info">
                                <p class="name_product">Iphone 16 promax</p>
                                <p class="type_product">Phân loại hàng: màu đen</p>
                                <p class="number_product">x1</p>
                            </div>
                        </div>
                        <p class="money">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_total">
                        <p class="content_total_p">Thành tiền: </p>
                        <p class="money_total">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_info_cancel">
                        <p>Hoàn thành</p>
                        <div class="content_button">
                            <button><p>Đánh giá</p></button>
                            <button onclick="showPopup()"><p>Trả hàng/Hoàn tiền</p></button>
                            <button><a href="..."><p>Mua lại</p></a></button>
                        </div>
                    </div>
                </div>
                <div class="content_bill_product">
                    <div class="content_cancel"><p>Giao hàng thành công</p></div>
                    <hr>
                    <div class="content_product">
                        <div class="content_product_nav">
                            <img src="img/Screenshot 2024-11-28 153840.png" alt="dien thoai">
                            <div class="content_product_info">
                                <p class="name_product">Iphone 16 promax</p>
                                <p class="type_product">Phân loại hàng: màu đen</p>
                                <p class="number_product">x1</p>
                            </div>
                        </div>
                        <p class="money">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_total">
                        <p class="content_total_p">Thành tiền: </p>
                        <p class="money_total">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_info_cancel">
                        <p>Hoàn thành</p>
                        <div class="content_button">
                            <button><p>Đánh giá</p></button>
                            <button onclick="showPopup()"><p>Trả hàng/Hoàn tiền</p></button>
                            <button><a href="..."><p>Mua lại</p></a></button>
                        </div>
                    </div>
                </div>
                <div class="content_bill_product">
                    <div class="content_cancel"><p>Trả hàng/Hoàn tiền</p></div>
                    <hr>
                    <div class="content_product">
                        <div class="content_product_nav">
                            <img src="img/Screenshot 2024-11-28 153840.png" alt="dien thoai">
                            <div class="content_product_info">
                                <p class="name_product">Iphone 16 promax</p>
                                <p class="type_product">Phân loại hàng: màu đen</p>
                                <p class="number_product">x1</p>
                            </div>
                        </div>
                        <p class="money">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_total">
                        <p class="content_total_p">Thành tiền: </p>
                        <p class="money_total">33.500.000</p>
                    </div>
                    <hr>
                    <div class="content_info_cancel">
                        <p>Trả hàng/Hoàn tiền</p>
                        <div class="content_button">
                            <button><a href="/Home/"><p>Xem chi tiết trả hàng</p></a></button>
                        </div>
                    </div>
                </div>
                    <div class="return_popup">
                    <ul class="choice">
                        <div class="title_button">
                            <p class="choice_title">Tình huống bạn đang gặp?</p>
                            <span class="close_button">&times;</span>
                        </div>
                        <li><button>
                                <a href="order_detail_return.php"><p class="reason_choice">Tôi đã nhận được hàng nhưng có vấn đề (bể vỡ, sai mẫu, hàng lỗi, khác mô tả...)-Miễn ship hoàn về</p></a>
                            </button></li>
                        <li><button>
                                <a href="order_detail_return.php">
                                    <p class="reason_choice">Tôi chưa nhận hàng/nhận thiếu hàng</p>
                                    <p class="note">Lưu ý: Trong trường hợp yêu cầu Trả hàng/Hoàn tiền của bạn được chấp nhận, Phí vận chuyển có thể không được hoàn lại </p>
                                </a>
                            </button></li>
                    </ul>
                </div>
            <script src="Javascript.js/order_return.js"></script>
        <?php include ("footer.php") ?>
        </div>
        </div>
</body>
</html>

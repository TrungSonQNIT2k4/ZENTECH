<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zentech.com</title><link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/order_all.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/order_detail_ship.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include ("/ZENTECH/Home/header.php") ?>
        <div class="bill_buy">
            <div class="nav_bill">
                <div class="nav_bill_user">
                    <img src="/img/438260813_2424897214565883_274795963423845468_n.jpg" alt="hinh anh">
                    <div class="nav_bill_user_info">
                       <div class="nav_bill_user_info_p">
                           <p>baotranxsb</p>
                           <p class="fix_info"><i class="fa-solid fa-pen"></i> Sửa hồ sơ</p>
                       </div>
                    </div>
                </div>
                <div class="nav_bill_link">
                    <a href=""><i class="fa-regular fa-user"></i> Tài Khoản Của Tôi</a>
                    <a href="/Home/order_all.php"><i class="fa-solid fa-clipboard-list"></i> Đơn Mua</a>
                </div>
            </div>
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
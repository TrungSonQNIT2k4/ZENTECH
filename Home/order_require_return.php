<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>zentech.com</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="/css/order_require_return.css">
        <link rel="stylesheet" href="/css/order_all.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
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
                                    </div>
                                </div>
                    </div>
        <?php include ("/ZENTECH/Home/footer.php") ?>
        </div>
        </div>
    </body>
</html>

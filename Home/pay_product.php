<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>zentech.com/thanhtoan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/pay_product.css">
    <link rel="stylesheet" href="/css/address_change.css">
    <link rel="stylesheet" href="/css/payment_method.css">
    <link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
</head>
<body>
    <h1><i class="fa-solid fa-bag-shopping"></i>ZENTECH | Thanh toán</h1>
    <div class="pay_product">
        <section id="address">
            <h3><i class="fas fa-map-marker-alt"></i>Địa chỉ nhận hàng</h3>
            <strong>
                <?php 
                // Thông tin người nhận
                $customer_name = "Nguyễn Thị Bảo Trân";
                $customer_phone = "0964860022";
                $customer_address = "27 Nguyễn Văn Hiển, Quy Nhơn";
                echo "$customer_name ($customer_phone)";
                ?>
            </strong>
            <span class="no1"> <?= $customer_address ?> </span>
            <button class="info_user_button" onclick="showPopupAddress()"> Thay đổi</button>
        </section>
        <section id="product">
            <table>
                <tr>
                    <th class="p1"><h4>Sản phẩm</h4></th>
                    <th class="p2"></th>
                    <th class="p1"><h4>Đơn giá</h4></th>
                    <th class="p2"><h4>Số lượng</h4></th>
                    <th class="p1"><h4>Thành tiền</h4></th>
                </tr>
                
                <?php
                // Mảng sản phẩm mẫu
                $products = [
                    [
                        'name' => 'Điện thoại Nubia Music NFC 8(4+4)/128GB | 6.6" HD+ 90Hz | 2 Jack tai nghe - Hàng chính hãng',
                        'type' => 'Màu xám',
                        'price' => 2506000,
                        'quantity' => 3,
                    ],
                    [
                        'name' => 'Điện thoại Redmi Note 12 Pro 5G (8GB/256GB)',
                        'type' => 'Màu xanh dương',
                        'price' => 6790000,
                        'quantity' => 1,
                    ]
                ];
                
                $total_price_product = 0;
                foreach ($products as $product) {
                    $product_total = $product['price'] * $product['quantity'];
                    $total_price_product += $product_total;
                    echo "
                    <tr>
                        <td class='name_product'>{$product['name']}</td>
                        <td class='type'>Loại: {$product['type']}</td>
                        <td class='price'>đ" . number_format($product['price'], 0, ',', '.') . "</td>
                        <td class='quantity'>{$product['quantity']}</td>
                        <td class='total_price'>đ" . number_format($product_total, 0, ',', '.') . "</td>
                    </tr>";
                }
                ?>

                <tr class="ship">
                    <td>Lời nhắn:
                        <textarea id="message" name="message" rows="2" cols="25" placeholder="Nhập lời nhắn của bạn"></textarea>
                    </td>
                    <td>Đơn vị vận chuyển:</td>
                    <td><p><b>Vận Chuyển Nhanh</b><br><pre>    Standard Express</pre></p></td>
                    <td><a href="">Thay đổi</a></td>
                    <td class="ship_money">đ30.000</td>
                </tr>

                <?php 
                $shipping_fee = 30000;
                $total_payment = $total_price_product + $shipping_fee;
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tổng số tiền:</td>
                    <td class="total_price_bill">đ<?= number_format($total_payment, 0, ',', '.') ?></td>
                </tr>

                <tr class="pay">
                    <td><h4>Phương thức thanh toán</h4></td>
                    <td></td>
                    <td></td>
                    <td class="choice_pay">Thanh toán khi nhận hàng</td>
                    <td><button class="button_payment" onclick="showPaymentPopup()">Thay đổi</button>
                </tr>
                <tr class="pay">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tổng tiền hàng:</td>
                    <td id="total_price_product">đ<?= number_format($total_price_product, 0, ',', '.') ?></td>
                </tr>

                <tr class="pay">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Phí vận chuyển:</td>
                    <td class="ship_money">đ<?= number_format($shipping_fee, 0, ',', '.') ?></td>
                </tr>

                <tr class="pay">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Tổng thanh toán:</td>
                    <td class="total_price_bill">đ<?= number_format($total_payment, 0, ',', '.') ?></td>
                </tr>

                <tr class="pay">
                    <td>Nhấn "Đặt hàng" đồng nghĩa với việc bạn đồng ý tuân theo 
                        <br> <a href="">Điều khoản Zentech</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a id="buy" type="submit">Đặt hàng</a></td>
                </tr>
            </table>
        </section>
</div>
<div class="payment_popup">
            <div class="payment_info_popup">
            <div class="payment_in_popup">
                <div class="info_title">
                    <p class="payment_title">Phương thức thanh toán</p>
                    <span class="close_button_payment">&times;</span>
                </div>
                    <div class="payment_choice">
                        <input type="radio" name="choice_payment" id="choice_1" value="Thanh toán khi nhận hàng">
                        <label for="choice_1" class="info_payment">
                            <p>Thanh toán khi nhận hàng</p>
                        </label >
                    </div>
                    <div class="payment_choice">
                    <input type="radio" name="choice_payment" id="choice_2" value="Thanh toán qua momo">
                        <label for="choice_2" class="info_payment">
                            <p>Thanh toán qua momo</p>
                        </label >
                    </div>
                    <div class="button_popup">
                        <a href=""><button class="button_cancel"> Hủy</button></a>
                        <a href=""><button class="button_confirm"> Xác nhận</button></a>
                    </div>
            </div>
        </div>
        <script src="/Javascript.js/payment_popup.js"></script>
    </div>
<div class="address_popup">
            <div class="info_popup">
            <div class="in_popup">
                <div class="info_title">
                    <p class="address_title">Địa Chỉ Của Tôi</p>
                    <span class="close_button_address">&times;</span>
                </div>
                    <div class="address_choice">
                        <input type="radio" name="choice_address" id="choice_1" value="Nguyễn Thị Bảo Trân|0964860022|Số 27, Nguyễn Văn Hiển, Phường Nguyễn Văn Cừ, Thành Phố Quy Nhơn, Bình Định">
                        <label for="choice_1" class="info_address">
                            <div class="info_user">
                            <p class="info_name">Nguyễn Thị Bảo Trân</p>
                            <p>0964860022</p> 
                            <a href="">Cập nhật</a>
                            </div>
                            <p>Số 27, Nguyễn Văn Hiển, Phường Nguyễn Văn Cừ, Thành Phố Quy Nhơn, Bình Định</p>  
                        </label >
                    </div>
                    <div class="address_choice">
                        <input type="radio" name="choice_address" id="choice_1" value="Nguyễn Thị Bảo Trân|0964860022|Số 27, Nguyễn Văn Hiển, Phường Nguyễn Văn Cừ, Thành Phố Quy Nhơn, Bình Định">
                        <label for="choice_1" class="info_address">
                            <div class="info_user">
                            <p class="info_name">Nguyễn Thị Bảo Trân</p>
                            <p>0964860022</p> 
                            <a href="">Cập nhật</a>
                            </div>
                            <p>Số 27, Nguyễn Văn Hiển, Phường Nguyễn Văn Cừ, Thành Phố Quy Nhơn, Bình Định</p>  
                        </label >
                    </div>
                    <div class="address_choice">
                        <input type="radio" name="choice_address" id="choice_1" value="Nguyễn Thị Bảo Trân|0964860022|Số 27, Nguyễn Văn Hiển, Phường Nguyễn Văn Cừ, Thành Phố Quy Nhơn, Bình Định">
                        <label for="choice_1" class="info_address">
                            <div class="info_user">
                            <p class="info_name">Nguyễn Thị Bảo Trân</p>
                            <p>0964860022</p> 
                            <a href="">Cập nhật</a>
                            </div>
                            <p>Số 27, Nguyễn Văn Hiển, Phường Nguyễn Văn Cừ, Thành Phố Quy Nhơn, Bình Định</p>  
                        </label >
                    </div>
                    <div class="address_choice">
                        <input type="radio" name="choice_address" id="choice_1" value="Nguyễn Thị Bảo Trân|0964860022|Số 27, Nguyễn Văn Hiển, Phường Nguyễn Văn Cừ, Thành Phố Quy Nhơn, Bình Định">
                        <label for="choice_1" class="info_address">
                            <div class="info_user">
                            <p class="info_name">Nguyễn Thị Bảo Trân</p>
                            <p >0964860022</p> 
                            <a href="">Cập nhật</a>
                            </div>
                            <p>Số 27, Nguyễn Văn Hiển, Phường Nguyễn Văn Cừ, Thành Phố Quy Nhơn, Bình Định</p>  
                        </label >
                    </div>
                    <div class="address_choice">
                        <input type="radio" name="choice_address" id="choice_2" value="">
                        <label for="choice_2" class="info_address">
                            <div class="info_user">
                                <p class="info_name">Nguyễn Thị Bảo Trân</p>
                                <p>0964860022</p> 
                                <a href="">Cập nhật</a>
                            </div>
                            <p>Xã Xuân Sơn Bắc, Huyện Đồng Xuân, Phú Yên</p>  
                        </label>
                    </div>
                    <div class="button_popup">
                        <a href=""><button class="button_cancel"> Hủy</button></a>
                        <a href=""><button class="button_confirm"> Xác nhận</button></a>
                    </div>
            </div>
        <script src="/Javascript.js/address_popup.js"></script>
    </div>
</div>
</body>
</html>

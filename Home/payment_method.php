<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zentech.com</title>
    <link rel="stylesheet" href="/css/payment_method.css">
    <link rel="stylesheet" href="/css/address_change.css">
</head>
<body>
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
                <script src="/Javascript.js/payment_popup.js"></script>
            </div>
    </div>
</body>
</html>
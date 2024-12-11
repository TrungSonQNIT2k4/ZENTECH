<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="assets/css/style-cart.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<section>
    <div class="container">
        <div class="cart-product">
            <!-- thông tin bên trái -->
             <div class="left">
             <div class="head">
           <div class="icon"><i class="ri-arrow-left-s-line"></i></div>
           <span class="text"> Quay lại</span>
        </div>
        <div class="icon-check">
            <div class="check"><i class="ri-checkbox-circle-line"></i></div>
            <span class="text">Giỏ hàng</span>
        </div>
        <div class="product-box">
           <div class="image-product"><img src="assets/image/z-fold6-thumb.webp"/>
             </div>
             <div class="name">
             Samsung Galaxy Z Fold6 12GB/1TB
             </div>
             <div class="price">
                <div class="price-sale">
                    52990000 đ
                </div>
                <div class="price-normal">
                    54990000 đ
                </div>
             </div>
                <div class="soluong">
                   <div class="flex">
                   <span class="text-count">Số lượng</span>
                   <div class="count">
                    <div class="dau">-</div>
                    <div class="dau">1</div>
                    <div class="dau">+</div>
                   </div>
                   </div>
                   <div class="delete-product">
                    -
                   </div>
                </div>
                <div class="list-voucher">
                <div class="voucher">
                <div class="stt">
                    KM1
                </div> 
                <div class="description-voucher">
                    <div class="circle">
                    <i class="ri-circle-fill"></i>
                    </div>
                    <div class="des-voucher"> Trả góp tới 06 tháng không lãi suất, trả trước 0 đồng với Samsung Finance+.</div>
                </div>  
                </div>  
                <div class="voucher">
                <div class="stt">
                    KM2
                </div> 
                <div class="description-voucher">
                <div class="circle">
                    <i class="ri-circle-fill"></i>
                    </div>
                    <div class="des-voucher"> Trả góp tới 06 tháng không lãi suất, trả trước 0 đồng với Samsung Finance+.</div>
                </div>  
                </div>  
                <div class="voucher">
                <div class="stt">
                    KM3
                </div> 
                <div class="description-voucher">
                <div class="circle">
                    <i class="ri-circle-fill"></i>
                    </div>
                   <div class="des-voucher"> Trả góp tới 06 tháng không lãi suất, trả trước 0 đồng với Samsung Finance+.</div>
                </div>  
                </div>  
                <div class="show-more">
                    <div class="more"><i class="ri-flashlight-line"></i></div>
                    <span>Xem thêm <strong>10</strong> khuyến mãi nữa</span>
                </div>
                </div>
                <div class="type">
                    <div class="version-box">
                        <span class="text-ver"> Phiên bản</span> 
                        <div class="version">
                        <i class="ri-checkbox-circle-fill"></i> 12GB/512GB
                        </div>
                    </div>
                    <div class="version-box">
                        <span class="text-ver">Màu sắc</span>
                        <div class="version">
                        <i class="ri-checkbox-circle-fill"></i>  Xanh
                        </div>
                    </div>
                </div>    
              </div>
              <div class="payment">
                <div class="pay">
                <p>Tổng giá trị: 52990000 đ<p>
                <p>Giảm giá: -00 đ</p>
                <p>Tổng thanh toán: <span style="color: red;">52990000 đ</span></p>
                </div>
              </div>
             </div>
        
        <!-- thông tin bên phải -->
        <div class="right">
            <h3>Thông tin đặt hàng</h3>
            <div class="text-vilid">
            Bạn cần nhập đầy đủ các trường thông tin có dấu *
            </div>
            <form>
            <div class="info">
            <input type="text" name="name" placeholder="Họ tên *">
            <br>
            <input type="number" name="phone" placeholder="Điện thoại">
            <br>
            <input type="text" name="email" placeholder="Email">
            </div>
            <br>
            <strong>Hình thức nhận hàng</strong>
            <div class="box-check">
            <div class="box-radio">
            <label>
            <input type="radio" id="home" name="home" value="home" checked />
             Nhận hành tại nhà
            </label>
            </div>
            <div class="box-radio">
            <label >
            <input type="radio" id="store" name="home" value="store" checked />
            Nhận hành tại của hàng
            </label>
            </div>
            </div>
            <strong>Nơi nhận hàng </strong>
            <div class="form">
            <select id="address" name="address" placeholder="Tỉnh/Thành phố *">
                <option value="">Tỉnh/ Thành phố*</option>
            </select>
            <select id="store" name="store" placeholder="Tỉnh/Thành phố *">
                <option value="">Cửa hàng*</option>
            </select>
            </div>
            <textarea class="note" title="Nội dung" placeholder="Ghi chú"></textarea>  
            <br>
            <div class="check-voucher">
            <label>
            <input type="checkbox" id="check" name="voucher" valvue="voucher" checked />  
            Xuất hóa đơn công ty (Điền email để nhận hóa đơn VAT)</label>   
            </div>
            <div class="voucher">
  <input type="text" placeholder="Nhập mã giảm giá">
  <button>Sử dụng</button>
     </div>
          <div class="xacnhan">
            <button type="button" onclick="alert('Hello Freetuts.net!')" value="Sử dụng">
           xác nhận và đặt hàng
           </button></div>
           <div class="text">Quý khách có thể lựa chọn hình thức thanh toán sau khi đặt hàng.</div>
            </form>
        </div>
       </div>
     </div>
</section>
</body>
</html>
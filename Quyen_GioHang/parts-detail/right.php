<?php
include('connect.php');
$_SESSION["user_id"] ="110" ;
$_SESSION["cart"] ="4" ;
$product_id = isset($_GET['id']) ? $_GET['id'] : null;
$user_id =$_SESSION["user_id"] ;
$cart_id = $_SESSION["cart"] ;
if ($product_id) {
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($connect, $query);
    $product = mysqli_fetch_assoc($result);

    $queryver = "SELECT products.product_id, version.product_id, version_id , version FROM products 
    inner join version on version.product_id = products.product_id 
    WHERE products.product_id = $product_id";
    $resultver = mysqli_query($connect, $queryver);

    $queryco = "SELECT products.product_id, color, img_url, code_color.color_id FROM products 
    inner join color_image on color_image.product_id = products.product_id 
    inner join code_color on color_image.color_id = code_color.color_id
    WHERE products.product_id = $product_id";
    $resultco = mysqli_query($connect, $queryco);

    $queryts = "SELECT thongso , thuoctinh , mota, product_id , thongso.id_thongso FROM thongso
                right join thuoctinh on thuoctinh.id_thongso = thongso.id_thongso
                inner join motathuoctinh on thuoctinh.id_thuoctinh = motathuoctinh.id_thuoctinh
                 WHERE product_id = $product_id AND is_highlight = '1'";
                $resultts = mysqli_query($connect, $queryts);
    $queryv = "SELECT * from voucher 
    where  product_id = $product_id";
    $resultv = mysqli_query($connect, $queryv) ;
}
if (isset($_POST['add-cart']) && $_POST['add-cart'] === 'add-cart') {
   $version = $_POST['version'] ?? null;
   $color = $_POST['color'] ?? null;
    if($user_id){
      if ($version && $color) {
         $check =" SELECT * from cart 
         where cart_id = '$cart_id'
               AND user_id= '$user_id'
               AND product_id = '$product_id'
               AND color_id = '$color'
               AND version_id = '$version'";
               $checkresult = mysqli_query($connect, $check) ;
               if(mysqli_num_rows($checkresult) > 0){
                  $update ="UPDATE cart SET quantity = quantity + 1 
                  WHERE cart_id = '$cart_id'
                        AND user_id = '$user_id'
                        AND product_id = '$product_id'
                        AND color_id = '$color'
                        AND version_id = '$version'";
                   if (mysqli_query($connect, $update)) {
                     echo "<script>alert('cập nhật vào giỏ hàng thành công!');</script>";
                     
                } else {
                    echo "<script>alert('Lỗi khi thêm vào giỏ hàng: " . mysqli_error($connect) . "');</script>";
                   
                }     
                  
               }
               else{
                  $query ="INSERT INTO cart(cart_id,user_id , product_id, color_id, version_id ,quantity) 
                  VALUES('$cart_id','$user_id','$product_id','$color','$version',1)" ;
                  if (mysqli_query($connect, $query)) {
                  
                     echo "<script>alert('thêm vào giỏ hàng thành công!');</script>";
                } else  {
                    echo "<script>alert('Lỗi khi thêm vào giỏ hàng: " . mysqli_error($connect) . "');</script>";
                } 
               }
      } else {
         echo "<script>alert('Vui lòng chọn màu sắc và phiên bản !');</script>";
      }
    }
    else{
      echo "<script>alert('Bạn phải đăng nhập trước khi thêm sản phẩm vào giỏ hàng!');</script>";
      //header("Location: login.php");
//         exit();
    }
}

function format_currency($number) {
  return number_format($number, 0, ',', '.') . ' đ';
}
?>
<div class="right-info">
            <!-- giá tiền -->
          <div class="top-detail">
            <div class="price-normal">
            <?php echo number_format($product['price'])?>đ
            </div>
            <div class="code-product">
            <!-- <p>SKU: <span class="code"> REDA2PDN </span></p> -->
            </div>
          </div> 
          <!-- lựa chọn phiên bản -->
            <form method="POST" action="">
            <input type="hidden" id="selected-version" name="version" value="">
            <input type="hidden" id="selected-color" name="color" value="">
           <div class="version-section">
            <div class="title-version">Lựa chọn phiên bản</div>
            <div class="list-version">
            <?php
                if (mysqli_num_rows($resultver) > 0) {
                  while ($row = mysqli_fetch_assoc($resultver)) {
                      echo '<div class="version-for-feature" data-value = "'.$row['version_id'].'">'.$row['version'].' <i class="ri-check-line"></i> </div>';
                  }
              } ?>
            
            </div>
              
           </div>
           <div class="version-section">
           <div class="title-version">Lựa chọn màu</div>
           <div class="list-version">
           <?php
                if (mysqli_num_rows($resultco) > 0) {
                  while ($row = mysqli_fetch_assoc($resultco)) {
                      echo '<button onclick="image('.$row['color_id'].')" type="button" class="box-color" data-value = "'.$row['color_id'].'" value="color_id" name="color_id">
                       <div class="image-bt"><img src="'.$row['img_url'].'" alt="" /></div>
                      <p>'.$row['color'].'</p> <i class="ri-check-line"></i>
                      </button>';
                  }
              } ?>
           </div>
           </div>
           <div class="button-product">
           <button type="submit" name="submit" class="registration">
                <div class="tittle-section">
                   mua ngay
                </div>
                <div class="sub-title">(Giao tận nhà hoặc nhận tại cửa hàng)</div>
        
            </button>
           <button type="submit" name="add-cart" class="cart" value="add-cart">
           <i class="ri-shopping-cart-fill"></i>
            <div class="add-cart">Thêm giỏ hàng</div> 
            </button>
           </div>
           <div class="paylater">
            <div class="paylater-by-money">
            <div class="tittle-section">trả góp 0%</div>
            <div class="sub-title">Trả trước chỉ từ 0đ</div>
            </div>
            <div class="paylater-by-card">
            <div class="tittle-section">trả góp qua thẻ</div>
            <div class="sub-title">(Visa, Mastercard, JBI)</div>
            </div>
           </div>
            </form>
           <!-- ưu đãi hoàng hà -->
           <!-- <div class="voucher-hoangha">
            <div class="title-voucher"> <i class="ri-vip-crown-2-line"></i> ưu đãi ZENTECH</div>
            <div class="sub-title">
            <div class="number-title">
                    1
           </div>
               <div class="description-voucher">Từ ngày 01/09 -30/9, khuyến mại giảm giá khi mua kèm Điện thoại và Máy tính bảng Xiaomi <a href="">(Xem chi tiết)</a></div>
            </div>
           </div> -->

           <!-- ưu đãi thêm -->
           <div class="voucher-more">
            <div class="title-voucher"> <i class="ri-gift-line"></i> ưu đãi ZENTECH</div>
            <div class="sub-title-list">
            <?php
                if (mysqli_num_rows($resultv) > 0) {
                  while ($row = mysqli_fetch_assoc($resultv)) {
           echo ' <div class="sub-title">
            <div  class="number-title">
                    '.$row['stt'].'
            </div>
               <div class="description-voucher">
                '.$row['mota'].'
            </div>
            </div> ';}}
            ?>
            
            </div>
          </div>
      
           <!-- thông số kĩ thuật -->
          <div class="specifications-box">
            <div class="box-title">
               <div class="specifications"><i class="ri-verified-badge-line"></i>
                thông số kĩ thuật
               </div>
               <div class="box-description">
               <ul class="description">
                  <?php
                if (mysqli_num_rows($resultts) > 0) {
                  while ($row = mysqli_fetch_assoc($resultts)) {
                 echo' <li><strong>'.$row['thuoctinh'].'</strong><span >'.$row['mota'].'</span></li>';
                  }
                  }
                  ?>
                </ul>
               </div>
            </div>
           
          </div>

        </div>
        
<Script>
document.addEventListener('DOMContentLoaded', () => {
    const versionElements = document.querySelectorAll('.version-for-feature');
    const colorElements = document.querySelectorAll('.box-color');
    const selectedVersionInput = document.getElementById('selected-version');
    const selectedColorInput = document.getElementById('selected-color');
    const mainImage = document.getElementById('main-image');

    // Xử lý chọn phiên bản
    versionElements.forEach(el => {
        el.addEventListener('click', () => {
            // Bỏ chọn tất cả
            versionElements.forEach(item => item.classList.remove('selected'));
            // Chọn phiên bản hiện tại
            el.classList.add('selected');
            // Gán giá trị vào input ẩn
            selectedVersionInput.value = el.dataset.value;
        });
    });

    // Xử lý chọn màu
    colorElements.forEach(el => {
        el.addEventListener('click', () => {
            // Bỏ chọn tất cả
            colorElements.forEach(item => item.classList.remove('selected'));
            // Chọn màu hiện tại
            el.classList.add('selected');
            // Gán giá trị vào input ẩn
            selectedColorInput.value = el.dataset.value;

            // Cập nhật ảnh chính dựa trên ảnh của màu được chọn
            const colorImageSrc = el.querySelector('img').getAttribute('src');
            mainImage.setAttribute('src', colorImageSrc);
            const colorId = el.dataset.value;

           
        });
    });
});

</Script>        
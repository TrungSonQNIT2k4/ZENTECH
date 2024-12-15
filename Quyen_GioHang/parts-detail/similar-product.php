<?php
include('connect.php') ;
$sql = "SELECT product_id, name, price, price_sale, image_main FROM products
 where product_id = $product_id";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_price = $row['price'];
}
$min_price = $product_price * 0.8; // Giảm 20%
$max_price = $product_price * 1.2; // Tăng 20%
$sql_similar = "SELECT product_id, name, price, price_sale, image_main 
                FROM products 
                
                where product_id != $product_id limit 5";

$result_similar = $connect->query($sql_similar);
?>
<section>
          <div class="container">
          <div class="list-product-similar">
              <div class="title-box">
                  sản phẩm cùng tầm giá - cấu hình khủng
                </div>
                  <div class="box-product-similar">
                    <!-- <button class="slider-left"><i class="ri-arrow-left-wide-line"></i></button>
                    <button class="slider-right">
                        <i class="ri-arrow-right-wide-fill"></i>
</button> -->
                    <div class="list-products" id="productSlider">
                    <?php
                if ($result->num_rows > 0) {
                    while($row = $result_similar->fetch_assoc()) {
                        echo '
                    
                        <a href="index.php?id=' . $row["product_id"] . '">
                    <div class="box-product">
                        <div class="product-similar">
                            <img src="assets/image/' . $row["image_main"] . '" alt=""/>
                        </div>
                         <div class="name-product">' . $row["name"] . '</div>
                        <div class="price">
                             <div class="price-sale">' . number_format($row["price_sale"]) . ' đ</div>
                             <div class="price-normal">' . number_format($row["price"]) . ' đ</div>
                        </div>
                    </div></a>' ;
                }
                } else {
                    echo "Không có sản phẩm nào.";
                }
                ?>
                    </div>
                    
                    
                    
                    </div>
                </div>
            </div>
    </section>
   
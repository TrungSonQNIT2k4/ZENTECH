<?php  
include('connect.php');

// Get the product_id from the URL
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($product_id) {
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($connect, $query);
    $product = mysqli_fetch_assoc($result);
} else {
    echo "Sản phẩm không tồn tại.";
}
?>
<section>
     <div class="container">
      <div class="product-detail">
        <div class="box-header">
          <div class="header-name">
          <?php echo $product['name'] ?>
          </div>
          
         </div>
        
       <div class="info-detail">
        <!-- thông tin bên trái -->
         <?php include('parts-detail/left.php')?>
         <!-- thông tin bên phải -->
         <?php include('parts-detail/right.php')?>
     </div>
     
        </div>
        </div>
    </section>
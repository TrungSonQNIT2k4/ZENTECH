<?php  
include('connect.php');
session_start() ;
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/style.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <title> Điện thoại Redmi A2+ (3GB/64GB) </title>
</head>
<body  onload="loaded()" >
<?php include('parts-detail/title.php') ;?>
    <?php 
    include('parts-detail/info-product.php') ;
    ?>
    <!-- sản phẩm tương tự -->
    <?php include('parts-detail/similar-product.php') ;?>
   <!-- so sanh san pham -->
   

 <!-- tin tuc lien quan  -->

 <!-- <?php include('parts-detail/news.php') ;?> -->

  <!-- binh luan cua khach hang -->
  <?php include('parts-detail/comment.php') ;?>

<!-- đánh giá của khách hàng -->
<!-- <?php include('parts-detail/reviews.php') ;?> -->
    
<script src="assets/js/script.js"></script>
</body>
</html>

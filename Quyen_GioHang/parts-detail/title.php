<?php
include('connect.php');

$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($product_id) {
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($connect, $query);
    $product = mysqli_fetch_assoc($result);
}
?>

<section>
    <div class="container">
        <ul class="breadcrum">
            <li><a href=""><i class="ri-home-heart-line"></i> Trang chủ</a></li> >
            <li><a href="">Điện thoại</a></li> >
            <li class="text-white"><a href=""><?php echo $product['name'] ?></a></li>
        </ul>
    </div>
</section>

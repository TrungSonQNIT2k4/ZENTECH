<?php  
include('connect.php');

// Lấy product_id từ URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : null;

$product = null; // Khởi tạo biến sản phẩm để tránh lỗi

if ($product_id) {
    // Truy vấn cơ sở dữ liệu
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($connect, $query);

    // Kiểm tra nếu truy vấn thành công và có kết quả
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    }
}

if (!$product) {
    echo "<div class='error'>Sản phẩm không tồn tại.</div>";
}
?>
<section>
    <div class="container">
        <div class="product-detail">
            <div class="box-header">
                <div class="header-name">
                    <?php 
                    // Hiển thị tên sản phẩm nếu tồn tại
                    echo isset($product['name']) ? htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') : "Sản phẩm không xác định";
                    ?>
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

<?php  
include('connect.php');

// Lấy product_id từ URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : null;

$product = null; // Khởi tạo biến sản phẩm để tránh lỗi

if ($product_id) {
    try {
        // Sử dụng PDO để truy vấn cơ sở dữ liệu
        $query = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['product_id' => $product_id]);

        // Kiểm tra nếu truy vấn có kết quả
        if ($stmt->rowCount() > 0) {
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
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

<?php
include('connect.php');

// Lấy ID sản phẩm từ URL (nếu có)
$product_id = isset($_GET['id']) ? intval($_GET['id']) : null;

$product = null; // Khởi tạo biến sản phẩm để tránh lỗi

// Kiểm tra giá trị product_id
if ($product_id) {
    try {
        // Truy vấn thông tin sản phẩm
        $query = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['product_id' => $product_id]);

        // Kiểm tra kết quả truy vấn
        if ($stmt->rowCount() > 0) {
            $product = $stmt->fetch(PDO::FETCH_ASSOC); // Lấy thông tin sản phẩm
        } else {
            echo "Không có sản phẩm nào với ID = $product_id.";
        }
    } catch (PDOException $e) {
        // Nếu có lỗi trong truy vấn SQL, hiển thị lỗi
        die("Lỗi SQL: " . $e->getMessage());
    }
} else {
    echo "Không có mã sản phẩm được cung cấp.";
}
?>

<section>
    <div class="container">
        <ul class="breadcrum">
            <li><a href="/ZENTECH/indexA.php"><i class="ri-home-heart-line"></i> Trang chủ</a></li> >
            <li><a href="/ZENTECH/showsp.php">Điện thoại</a></li> >
            <li class="text-white">
                <!-- Kiểm tra nếu sản phẩm tồn tại -->
                <?php if (!empty($product)) { ?>
                    <a href=""><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></a>
                <?php } else { ?>
                    <a href="#">Sản phẩm không tồn tại</a>
                <?php } ?>
            </li>
        </ul>
    </div>
</section>

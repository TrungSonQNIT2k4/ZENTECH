<?php
include('connect.php');

// Lấy product_id từ URL và kiểm tra tính hợp lệ
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$product_id) {
    echo "Không có mã sản phẩm được cung cấp.";
    exit;
}

// Sử dụng PDO để truy vấn lấy thông tin sản phẩm
$sql = "SELECT product_id, name, price, image_path FROM products WHERE product_id = :product_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt->execute();

// Kiểm tra kết quả truy vấn
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $product_price = $row['price'];
    $product_name = $row['name'];
    $product_image = $row['image_path'];
} else {
    echo "Không tìm thấy sản phẩm với mã ID = $product_id.";
    exit;
}

// Tính giá min/max
$min_price = $product_price * 0.5;
$max_price = $product_price * 2; 

// Truy vấn lấy các sản phẩm tương tự
$sql_similar = "SELECT product_id, name, price, image_path 
                FROM products 
                WHERE product_id != :product_id 
                AND price BETWEEN :min_price AND :max_price
                ORDER BY RAND()
                LIMIT 5"; // Lọc sản phẩm cùng tầm giá

$stmt_similar = $pdo->prepare($sql_similar);
$stmt_similar->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt_similar->bindParam(':min_price', $min_price, PDO::PARAM_INT);
$stmt_similar->bindParam(':max_price', $max_price, PDO::PARAM_INT);
$stmt_similar->execute();

// Kiểm tra lỗi truy vấn
if ($stmt_similar === false) {
    echo "Lỗi truy vấn: " . $pdo->errorInfo()[2];
    exit;
}
?>

<section>
    <div class="main-container">
        <div class="list-product-similar">
            <div class="title-box">
                Sản phẩm cùng tầm giá - cấu hình khủng
            </div>
            <div class="box-product-similar">
                <div class="list-products" id="productSlider">
                    <?php
                    if ($stmt_similar->rowCount() > 0) {
                        while ($row = $stmt_similar->fetch(PDO::FETCH_ASSOC)) {
                            echo '
                            <a href="/ZENTECH/Quyen_giohang/index-detail.php?id=' . $row["product_id"] . '">
                                <div class="box-product">
                                    <div class="product-similar">
                                        <img src="' . $row["image_path"] . '" alt=""/>
                                    </div>
                                    <div class="name-product">' . $row["name"] . '</div>
                                    <div class="price">
                                        <div class="price-normal">' . number_format($row["price"]) . ' đ</div>
                                    </div>
                                </div>
                            </a>';
                        }
                    } else {
                        echo "Không có sản phẩm tương tự.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

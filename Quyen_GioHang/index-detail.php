<?php  
// Bao gồm file kết nối PDO
include('connect.php');
session_start();

// Kiểm tra người dùng đã đăng nhập hay chưa
if (isset($_SESSION['user_id'])) {
    $headerFile = $_SERVER['DOCUMENT_ROOT'].'/ZENTECH/headerA.php';
    $user_id = $_SESSION['user_id']; // Lấy user_id từ session
} else {
    $headerFile = $_SERVER['DOCUMENT_ROOT'].'/ZENTECH/header.php';
    $user_id = null; // Nếu chưa đăng nhập, gán user_id là null
}
$cart_id=$_SESSION['cart_id'];

// Lấy product_id từ URL
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($product_id) {
    try {
        // Sử dụng câu lệnh chuẩn bị (prepared statement) để tránh SQL injection
        $query = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $pdo->prepare($query);  // Sử dụng biến $pdo thay vì $connect
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Lấy dữ liệu sản phẩm
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "Sản phẩm không tồn tại.";
            exit();
        }
    } catch(PDOException $e) {
        echo "Lỗi khi truy vấn sản phẩm: " . $e->getMessage();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/ZENTECH/Quyen_GioHang/assets/css/style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/ZENTECH/style.css">
    <link rel="icon" href="/ZENTECH/Data/Image/ICONLOGOZ.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <title>Zentech - <?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body onload="loaded()">
<?php include($headerFile); ?>
<div class="main-index-detail">
    <?php include('parts-detail/title.php'); ?>
    <?php include('parts-detail/info-product.php'); ?>
    <!-- sản phẩm tương tự -->
    <?php include('parts-detail/similar-product.php'); ?>
    <!-- so sanh san pham -->
    
    <!-- tin tuc lien quan  -->
    
    <!-- <?php include('parts-detail/news.php'); ?> -->
    
    <!-- binh luan cua khach hang -->
    <?php include('parts-detail/comment.php'); ?>
    
    <!-- đánh giá của khách hàng -->
    <!-- <?php include('parts-detail/reviews.php'); ?> -->
        
    <script src="assets/js/script.js"></script>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/ZENTECH/footer.php'); ?>
</body>
</html>

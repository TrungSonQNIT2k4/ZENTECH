<?php
include 'header.php';

if (!empty($_SESSION['current_user']) && isset($_GET['id'])) {
    // Lấy ID sản phẩm cần copy
    $id = (int)$_GET['id'];

    // Truy vấn lấy thông tin sản phẩm cần sao chép
    $stmt = $con->prepare("SELECT * FROM `products` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if ($product) {
        // Sao chép thông tin sản phẩm
        $stmt = $con->prepare("INSERT INTO `products` (`name`, `image_path`, `price`, `description`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssii", $product['name'], $product['image_path'], $product['price'], $product['description'], $product['created_at'], $product['updated_at']);
        if ($stmt->execute()) {
            // Tính toán số lượng sản phẩm hiện tại để chuyển đến trang cuối cùng
            $stmt = $con->prepare("SELECT COUNT(*) FROM `products`");
            $stmt->execute();
            $stmt->bind_result($totalRecords);
            $stmt->fetch();
            $stmt->close();

            // Số sản phẩm trên mỗi trang
            $item_per_page = 10;
            // Tính tổng số trang
            $totalPages = ceil($totalRecords / $item_per_page);

            // Hiển thị thông báo thành công bằng alert
            echo "<script>
                    alert('Sao chép sản phẩm thành công!');
                    window.location.href = './product_listing.php?page=$totalPages';
                  </script>";
            exit; // Dừng script lại sau khi chuyển hướng
        } else {
            echo "<div class='error'>Có lỗi xảy ra khi sao chép sản phẩm.</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='error'>Không tìm thấy sản phẩm cần sao chép.</div>";
    }
}

include './footer.php';
?>

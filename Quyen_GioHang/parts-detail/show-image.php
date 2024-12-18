<?php
include('connect.php');

// Nhận product_id và color_id từ GET hoặc POST
$product_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$color_id = isset($_GET['color_id']) ? intval($_GET['color_id']) : null;

// Khởi tạo biến
$product = null;
$imageData = [];

// Kiểm tra product_id có hợp lệ không
if ($product_id) {
    try {
        // Truy vấn ảnh chính của sản phẩm
        $querymain = "SELECT image_path FROM products WHERE product_id = :product_id";
        $stmtmain = $pdo->prepare($querymain);
        $stmtmain->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmtmain->execute();

        if ($stmtmain->rowCount() > 0) {
            $product = $stmtmain->fetch(PDO::FETCH_ASSOC);
        }

        // Truy vấn ảnh chi tiết và màu sắc
        $query = "
            SELECT 
                detail_image.image_url AS detail_image_url,
                color_image.img_url AS color_img_url,
                code_color.color_id AS color_id
            FROM products
            LEFT JOIN color_image ON color_image.product_id = products.product_id
            LEFT JOIN code_color ON code_color.color_id = color_image.color_id
            LEFT JOIN detail_image ON color_image.color_id = detail_image.color_id
            WHERE products.product_id = :product_id
        ";
        
        // Nếu có color_id thì lọc theo color_id
        if ($color_id) {
            $query .= " AND color_image.color_id = :color_id";
        }

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        
        if ($color_id) {
            $stmt->bindParam(':color_id', $color_id, PDO::PARAM_INT);
        }

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $imageData[] = $row;
            }
        }
    } catch (PDOException $e) {
        echo "Lỗi khi truy vấn dữ liệu: " . $e->getMessage();
    }
}
?>

<div class="box-image-product">
    <?php if (!empty($imageData)): ?>
        <?php $mainImage = $imageData[0]; ?>
        <img id="main-image" data-color-id="<?= htmlspecialchars($mainImage['color_id'], ENT_QUOTES, 'UTF-8') ?>" src="<?= htmlspecialchars($mainImage['color_img_url'], ENT_QUOTES, 'UTF-8') ?>" alt="Product Image">
    <?php else: ?>
        <img id="main-image" src="/ZENTECH/Quyen_giohang/assets/image/default.png" alt="No Image">
    <?php endif; ?>
    <button class="box-slider-left">
        <i class="ri-arrow-left-s-line"></i>
    </button>
    <button class="box-slider-right">
        <i class="ri-arrow-right-s-line"></i>
    </button>
</div>

<div class="more-image">
    <?php if (!empty($imageData)): ?>
        <?php foreach ($imageData as $image): ?>
            <div class="image-detail" data-color-id="<?= htmlspecialchars($image['color_id'], ENT_QUOTES, 'UTF-8') ?>">
                <button class="image-pr">
                    <img src="<?= htmlspecialchars($image['detail_image_url'], ENT_QUOTES, 'UTF-8') ?>" alt="Detail Image">
                </button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const mainImage = document.getElementById('main-image');
    const detailImages = Array.from(document.querySelectorAll('.more-image .image-detail .image-pr img')); // Chuyển NodeList thành mảng
    const leftButton = document.querySelector('.box-slider-left');
    const rightButton = document.querySelector('.box-slider-right');

    let currentIndex = 0;

    function updateMainImage(index) {
        if (index >= 0 && index < detailImages.length) {
            mainImage.setAttribute('src', detailImages[index].getAttribute('src'));
            currentIndex = index;
        }
    }

    leftButton.addEventListener('click', () => {
        const newIndex = (currentIndex - 1 + detailImages.length) % detailImages.length;
        updateMainImage(newIndex);
    });

    rightButton.addEventListener('click', () => {
        const newIndex = (currentIndex + 1) % detailImages.length;
        updateMainImage(newIndex);
    });

    detailImages.forEach((img, index) => {
        img.addEventListener('click', () => {
            updateMainImage(index);
        });
    });

    if (detailImages.length > 0) {
        updateMainImage(0);
    }
});
</script>

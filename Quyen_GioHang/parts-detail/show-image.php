<?php
include('connect.php');

$product_id = isset($_GET['id']) ? $_GET['id'] : null;
$color_id = isset($_GET['color_id']) ? $_GET['color_id'] : null;

if (isset($_POST['color_id']) && $_POST[''] === 'color_id') {
    $color_id = $_POST['color_id'];
    echo $color_id;
}

$product = null;
$imageData = []; // Khởi tạo để tránh lỗi nếu không có dữ liệu
$resultmain = null; // Đảm bảo biến được khởi tạo
$result = null;

if ($product_id) {
    // Truy vấn ảnh chính
    $querymain = "SELECT image_path FROM products WHERE products.product_id = $product_id";
    $resultmain = mysqli_query($connect, $querymain);
    $product = mysqli_fetch_assoc($resultmain);

    // Truy vấn dữ liệu chi tiết
    $query = "
        SELECT image_path, color, img_url, image_url, code_color.color_id
        FROM products
        LEFT JOIN color_image ON color_image.product_id = products.product_id
        LEFT JOIN code_color ON code_color.color_id = color_image.color_id
        LEFT JOIN detail_image ON color_image.color_id = detail_image.color_id
        WHERE products.product_id = $product_id AND color_image.color_id = '1'
    ";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $imageData[] = $row; // Lưu dữ liệu vào mảng
        }
    }
}
?>

<div class="box-image-product">
    <?php
    if (!empty($imageData)) {
        $mainImage = $imageData[0]; // Lấy ảnh đầu tiên làm ảnh chính
        echo '<img id="main-image" data-color-id="' . $mainImage['color_id'] . '" src="' . $mainImage['img_url'] . '" alt="">'; // Định dạng PNG
    } else {
        echo '<img id="main-image" src="assets/image/default.png" alt="No Image">';
    }
    ?>
    <button class="box-slider-left">
        <i class="ri-arrow-left-s-line"></i>
    </button>
    <button class="box-slider-right">
        <i class="ri-arrow-right-s-line"></i>
    </button>
</div>

<div class="more-image">
    <?php
    if (!empty($imageData)) {
        foreach ($imageData as $image) {
            echo '
            <div class="image-detail" data-color-id="' . $image['color_id'] . '">
                <button class="image-pr">
                    <img src="' . $image['image_url'] . '" alt="" />
                </button>
            </div>';
        }
    }
    ?>
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

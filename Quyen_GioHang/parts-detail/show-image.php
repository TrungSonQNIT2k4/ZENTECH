<?php
include('connect.php');

$product_id = isset($_GET['id']) ? $_GET['id'] : null;
$color_id = isset($_GET['color_id']) ? $_GET['color_id'] : null;
if (isset($_POST['color_id']) && $_POST[''] === 'color_id') {
    $color_id =  $_POST['color_id'] ;
    echo $color_id ;

}
if ($product_id) {
    $querymain = "SELECT image_main  FROM products
     WHERE products.product_id = $product_id";
    $resultmain = mysqli_query($connect, $querymain);
    $product = mysqli_fetch_assoc($resultmain);

    $query = "SELECT image_main, color, img_url,image_url, code_color.color_id FROM products
    left join color_image on color_image.product_id = products.product_id
    left join code_color on code_color.color_id = color_image.color_id
    left join detail_image on color_image.color_id = detail_image.color_id
     WHERE products.product_id = $product_id and color_image.color_id = '1' ";
    $result = mysqli_query($connect, $query);
   
}


?>
<?php
$imageData = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $imageData[] = $row; // Lưu dữ liệu vào mảng
    }
}




?>
<div class="box-image-product">
    <?php
    

    if (!empty($imageData)) {
        $mainImage = $imageData[0]; // Lấy ảnh đầu tiên làm ảnh chính
        echo '<img id="main-image" data-color-id="' . $mainImage['color_id'] . '" src="assets/image/' . $mainImage['img_url'] . '" alt="">'; // Định dạng PNG
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
                    <img src="assets/image/' . $image['image_url'] . '" alt="" /> <!-- Định dạng WEBP -->
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

    // Cập nhật ảnh chính và chỉ số hiện tại
    function updateMainImage(index) {
        if (index >= 0 && index < detailImages.length) {
            mainImage.setAttribute('src', detailImages[index].getAttribute('src'));
            currentIndex = index;
        }
    }

    // Xử lý nút bên trái
    leftButton.addEventListener('click', () => {
        const newIndex = (currentIndex - 1 + detailImages.length) % detailImages.length; // Quay vòng
        updateMainImage(newIndex);
    });

    // Xử lý nút bên phải
    rightButton.addEventListener('click', () => {
        const newIndex = (currentIndex + 1) % detailImages.length; // Quay vòng
        updateMainImage(newIndex);
    });

    // Gắn sự kiện cho từng ảnh để nhấn vào ảnh thay đổi main-image
    detailImages.forEach((img, index) => {
        img.addEventListener('click', () => {
            updateMainImage(index);
        });
    });

    // Cập nhật ảnh chính ban đầu
    if (detailImages.length > 0) {
        updateMainImage(0); // Ảnh đầu tiên
    }
});

</script>



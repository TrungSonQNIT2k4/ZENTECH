<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZENTECH</title>
    <link rel="stylesheet" href="/ZENTECH/style.css">
    <link rel="icon" type="image/png" href="/ZENTECH/Data/Image/ICONLOGOZ.png" />
    <link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
</head>
<body>
<?php
// Tạo một hàm kết nối cơ sở dữ liệu để sử dụng lại
function connectDatabase() {
    $conn = new mysqli("localhost", "root", "", "zentech");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}
?>
    <?php include 'headerA.php'; ?>
    <div class="container_show_item">
        <div class="menu_choose">
            <div class="Sort">
                <p>Sắp xếp</p>
                <div class="tools">
                    <button>Giá</button>
                    <button>Bán chạy</button>
                    <button>Mới nhất</button>
                </div>
            </div>
            <div class="Price_choose">
                <p>Giá</p>
                <div></div>
            </div>
            <div class="Brand_choose">
                <p>Thương hiệu</p>
                <div class="Brand_tools">
                    <button>Samsung</button>
                    <button>iPhone</button>
                    <button>Xiaomi</button>
                    <button>Oppo</button>
                    <button>Phụ kiện</button>
                </div>
            </div>
        </div>
        <div class="Show_item">
            <div class="item">
                <p>Apple</p>
                <div class="item_link">
                    <button>
                        <img src="/ZENTECH/Data/Image/ip16promax.jpg" alt="">
                        iPhone 16 Pro Max VN/A
                        <p class="price">34,990,000</p>
                    </button>
                    <button>
                        <img src="/ZENTECH/Data/Image/ip16pro.jpg" alt="">
                        iPhone 16 Pro VN/A
                        <p class="price">28,990,000</p>
                    </button>
                    <button>
                        <img src="/ZENTECH/Data/Image/ip16plus.jpg" alt="">
                        iPhone 16 Plus VN/A
                        <p class="price">25,990,000</p>
                    </button>
                    <button>
                        <img src="/ZENTECH/Data/Image/ip16.jpg" alt="">
                        iPhone 16 VN/A
                        <p class="price">22,290,000</p>
                    </button>
                </div>
            </div>
        </div>    
    </div>
    <?php include 'footer.php';?>
</body>
</html>
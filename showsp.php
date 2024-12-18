<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZENTECH</title>
    <link rel="stylesheet" href="/ZENTECH/style.css">
    <link rel="icon" type="image/png" href="/ZENTECH/Data/Image/ICONLOGOZ.png" />
    <link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function buildUrl(params) {
    const url = new URL(window.location.href);
    Object.keys(params).forEach(key => {
        if (params[key]) {
            url.searchParams.set(key, params[key]);
        } else {
            url.searchParams.delete(key);
        }
    });
    return url.toString();
}

function applyFilter(type, value, group) {
    const params = {};
    params[type] = value;
    const newUrl = buildUrl(params);

    // Gửi AJAX request mà không tải lại trang
    $.ajax({
        url: newUrl,
        method: 'GET',
        success: function(response) {
            // Cập nhật phần hiển thị sản phẩm mà không tải lại trang
            const newItems = $(response).find('.Show_item').html();
            $('.Show_item').html(newItems);
            history.pushState(null, null, newUrl);  // Cập nhật URL mà không tải lại trang
        },
        error: function(xhr, status, error) {
            console.error("Error loading the data: ", error);
        }
    });

    // Cập nhật màu nút đã chọn cho từng nhóm
    const buttons = document.querySelectorAll(`.${group} .btn-group button`);
    
    // Xóa lớp 'active' khỏi tất cả các nút trong nhóm
    buttons.forEach(button => button.classList.remove('active'));
    
    // Thêm lớp 'active' vào nút được chọn
    const selectedButton = Array.from(buttons).find(button => button.getAttribute('data-value') === value);
    if (selectedButton) {
        selectedButton.classList.add('active');
    }
}

// Đặt active cho nút đã được chọn khi tải lại trang
$(document).ready(function() {
    const currentParams = new URLSearchParams(window.location.search);
    currentParams.forEach((value, key) => {
        applyFilter(key, value, `${key}_choose`);
    });
});

    </script>
</head>

<body>
    <?php
    // Kết nối cơ sở dữ liệu
    require 'db.php';

    // Xử lý tham số GET
    $selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : '';
    $selectedMemory = isset($_GET['memory']) ? $_GET['memory'] : '';
    $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : '';

    // Truy vấn sản phẩm với kết nối bảng version
    $query = "SELECT p.product_id, p.name, p.price, p.image_path 
              FROM products p
              LEFT JOIN version v ON p.product_id = v.product_id";
    $conditions = [];

    // Thêm điều kiện lọc theo thương hiệu
    if ($selectedBrand) {
        switch ($selectedBrand) {
            case 'iphone':
                $conditions[] = "p.product_id BETWEEN 100 AND 199";
                break;
            case 'samsung':
                $conditions[] = "p.product_id BETWEEN 200 AND 299";
                break;
            case 'xiaomi':
                $conditions[] = "p.product_id BETWEEN 300 AND 399";
                break;
            case 'oppo':
                $conditions[] = "p.product_id BETWEEN 400 AND 499";
                break;
            case 'accessories':
                $conditions[] = "p.product_id BETWEEN 500 AND 599";
                break;
        }
    }

    // Thêm điều kiện lọc theo bộ nhớ
    if ($selectedMemory) {
        $conditions[] = "v.version = '$selectedMemory'";
    }

    // Thêm điều kiện sắp xếp
    $orderBy = "";
    if ($sortOrder) {
        switch ($sortOrder) {
            case 'price_asc':
                $orderBy = " ORDER BY p.price ASC";
                break;
            case 'price_desc':
                $orderBy = " ORDER BY p.price DESC";
                break;
        }
    }

    // Gộp điều kiện vào truy vấn
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }
    $query .= $orderBy;

    // Thực thi truy vấn
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Lỗi khi lấy danh sách sản phẩm: " . $e->getMessage());
    }
    ?>

    <?php include 'headerA.php'; ?>

    <div class="container_show_item">
        <!-- Bộ lọc sản phẩm -->
        <div class="menu_choose">
            <!-- Bộ lọc theo Thương hiệu -->
            <div class="Brand_choose">
    <p>Thương hiệu</p>
    <div class="btn-group">
        <button type="button" data-value="" onclick="applyFilter('brand', '', 'Brand_choose')">Tất cả</button>
        <button type="button" data-value="iphone" onclick="applyFilter('brand', 'iphone', 'Brand_choose')">Apple</button>
        <button type="button" data-value="samsung" onclick="applyFilter('brand', 'samsung', 'Brand_choose')">Samsung</button>
        <button type="button" data-value="xiaomi" onclick="applyFilter('brand', 'xiaomi', 'Brand_choose')">Xiaomi</button>
        <button type="button" data-value="oppo" onclick="applyFilter('brand', 'oppo', 'Brand_choose')">Oppo</button>
        <button type="button" data-value="accessories" onclick="applyFilter('brand', 'accessories', 'Brand_choose')">Phụ kiện</button>
    </div>
</div>


<!-- Bộ lọc theo Bộ nhớ -->
<!-- Bộ lọc theo Bộ nhớ -->
<div class="Memory_choose">
    <p>Bộ nhớ</p>
    <div class="btn-group">
        <button type="button" data-value="" onclick="applyFilter('memory', '', 'Memory_choose')">Tất cả</button>
        <button type="button" data-value="32Gb" onclick="applyFilter('memory', '32Gb', 'Memory_choose')">32GB</button>
        <button type="button" data-value="64Gb" onclick="applyFilter('memory', '64Gb', 'Memory_choose')">64GB</button>
        <button type="button" data-value="128Gb" onclick="applyFilter('memory', '128Gb', 'Memory_choose')">128GB</button>
        <button type="button" data-value="256Gb" onclick="applyFilter('memory', '256Gb', 'Memory_choose')">256GB</button>
        <button type="button" data-value="512Gb" onclick="applyFilter('memory', '512Gb', 'Memory_choose')">512GB</button>
    </div>
</div>


<!-- Bộ lọc theo Sắp xếp -->
<div class="Sort">
    <p>Sắp xếp</p>
    <div class="btn-group">
        <button type="button" data-value="" onclick="applyFilter('sort', '', 'Sort')">Mặc định</button>
        <button type="button" data-value="price_asc" onclick="applyFilter('sort', 'price_asc', 'Sort')">Giá tăng dần</button>
        <button type="button" data-value="price_desc" onclick="applyFilter('sort', 'price_desc', 'Sort')">Giá giảm dần</button>
    </div>
</div>


        </div>

        <!-- Hiển thị sản phẩm -->
        <div class="Show_item">
            <div class="item">
                <p>
                    <?php
                    // Hiển thị tên thương hiệu nếu có
                    if ($selectedBrand) {
                        switch ($selectedBrand) {
                            case 'iphone': echo "Apple"; break;
                            case 'samsung': echo "Samsung"; break;
                            case 'xiaomi': echo "Xiaomi"; break;
                            case 'oppo': echo "Oppo"; break;
                            case 'accessories': echo "Phụ kiện"; break;
                            default: echo "Sản phẩm";
                        }
                    } else {
                        echo "Sản phẩm";
                    }
                    ?>
                </p>
                <div class="item_link">
                    <?php if (!empty($products)) : ?>
                        <?php foreach ($products as $product) : ?>
                            <a href="/ZENTECH/Quyen_giohang/index-detail.php?id=<?= htmlspecialchars($product['product_id']); ?>">
                                <button>
                                    <img src="<?= htmlspecialchars($product['image_path']); ?>" alt="Product Image">
                                    <?= htmlspecialchars($product['name']); ?>
                                    <p class="price"><?= number_format($product['price'], 0, ',', '.') . ' đ'; ?></p>
                                </button>
                            </a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Không có sản phẩm nào được tìm thấy.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>

<link rel="stylesheet" href="css/admin_style.css">
<style type="text/css">
    /* Định dạng cho các liên kết */
    a {
        color: blue;
        /* Màu mặc định cho liên kết */
        text-decoration: none;
        /* Không gạch chân */
    }

    a:visited {
        color: blue;
        /* Màu khi đã truy cập */
    }

    a:hover,
    a:active {
        color: #333;
        /* Giữ nguyên màu khi di chuột hoặc nhấn */
        text-decoration: underline;
        /* Gạch chân khi hover */
    }
</style>

<?php
include 'header.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!empty($_SESSION['current_user'])) {
    // Số sản phẩm hiển thị trên mỗi trang
    $item_per_page = (!empty($_GET['per_page'])) ? (int)$_GET['per_page'] : 10;

    // Lấy trang hiện tại từ URL, nếu không có thì mặc định là trang 1
    $current_page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;

    // Tính toán vị trí bắt đầu lấy dữ liệu (offset)
    $offset = ($current_page - 1) * $item_per_page;

    // Sử dụng Prepared Statement để lấy tổng số sản phẩm
    $stmt = $con->prepare("SELECT COUNT(*) FROM `products`");
    $stmt->execute();
    $stmt->bind_result($totalRecords);
    $stmt->fetch();
    $stmt->close();

    // Tính tổng số trang dựa trên tổng số sản phẩm và số sản phẩm trên mỗi trang
    $totalPages = ceil($totalRecords / $item_per_page);

    // Truy vấn các sản phẩm với phân trang
    $stmt = $con->prepare("SELECT * FROM `products` ORDER BY `id` ASC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $item_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    // Fetch tất cả sản phẩm vào một mảng
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

?>
    <div class="main-content">
        <h1>Danh sách sản phẩm</h1>
        <div class="product-items">
            <div class="buttons">
                <button><a class="add_product" href="./product_editing.php">Thêm sản phẩm</a></button>
            </div>
            <ul>
                <li class="product-item-heading">
                    <div class="product-prop-header product-id">id</div>
                    <div class="product-prop-header product-img">Ảnh</div>
                    <div class="product-prop-header product-name">Tên sản phẩm</div>
                    <div class="product-prop-header product-Price">Giá</div>
                    <div class="product-prop-header product-time">Ngày tạo</div>
                    <div class="product-prop-header product-time">Ngày cập nhật</div>
                    <div class="product-button-title">Chức năng</div>
                    <div class="clear-both"></div>
                </li>
                <?php
                // Lặp qua từng sản phẩm để hiển thị
                foreach ($products as $row) {
                ?>
                    <li>
                        <div class="product-prop product-id"><?= htmlspecialchars($row['id']) ?></div>
                        <div class="product-prop product-img">
                            <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" title="<?= htmlspecialchars($row['name']) ?>" />
                        </div>
                        <div class="product-prop product-name"><?= htmlspecialchars($row['name']) ?></div>
                        <div class="product-prop product-price"><?= number_format($row["price"], 0, ',', '.') ?></div>
                        <div class="product-prop product-time"><?= date($row['created_at']) ?></div>
                        <div class="product-prop product-time"><?= date($row['updated_at']) ?></div>
                        <div class="product-prop product-button">
                            <a href="./product_editing.php?id=<?= htmlspecialchars($row['id']) ?>">Sửa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./product_copy.php?id=<?= htmlspecialchars($row['id']) ?>">Copy</a>
                        </div>

                        <div class="product-prop product-button">
                            <a href="./product_delete.php?id=<?= htmlspecialchars($row['id']) ?>">Xóa</a>
                        </div>
                        <div class="clear-both"></div>
                    </li>
                <?php } ?>
            </ul>
            <?php include './pagination.php'; ?>
            <div class="clear-both"></div>
        </div>
    </div>
<?php
}
include './footer.php';
?>
<link rel="stylesheet" href="css/admin_style.css">
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
    $stmt = $con->prepare("SELECT COUNT(*) FROM `comment`");
    $stmt->execute();
    $stmt->bind_result($totalRecords);
    $stmt->fetch();
    $stmt->close();

    // Tính tổng số trang dựa trên tổng số sản phẩm và số sản phẩm trên mỗi trang
    $totalPages = ceil($totalRecords / $item_per_page);

    // Truy vấn các sản phẩm với phân trang
    $stmt = $con->prepare("SELECT * FROM `comment` ORDER BY `comment_id` ASC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $item_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    // Fetch tất cả sản phẩm vào một mảng
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

?>
    <div class="main-content">
        <h1>Danh sách bình luận</h1>
        <div class="product-items">
            <ul>
                <li class="product-item-heading">
                    <div class="product-prop-header comment-id">id</div>
                    <div class="product-prop-header comment-content">Nội dung</div>
                    <div class="product-prop-header comment-time">Thời gian</div>
                    <div class="product-prop-header product-id">ID sản phẩm</div>
                    <div class="product-prop-header customer-id">ID khách hàng</div>
                    <div class="product-button-title">Chức năng</div>
                    <div class="clear-both"></div>
                </li>
                <?php
                // Lặp qua từng sản phẩm để hiển thị
                foreach ($products as $row) {
                ?>
                    <li>
                        <div class="product-prop comment-id"><?= htmlspecialchars($row['comment_id']) ?></div>
                        <div class="product-prop comment-content"><?= htmlspecialchars($row['noidung']) ?></div>
                        <div class="product-prop comment-time"><?= date($row['created_at']) ?></div>
                        <div class="product-prop product-id"><?= htmlspecialchars($row['product_id']) ?></div>
                        <div class="product-prop customer-id"><?= htmlspecialchars($row['customer_id']) ?></div>
                        <div class="product-prop product-button">
                            <a href="./comment_delete.php?id=<?= htmlspecialchars($row['comment_id']) ?>">Xóa</a>
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
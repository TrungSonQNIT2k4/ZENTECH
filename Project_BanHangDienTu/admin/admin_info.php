<?php
include 'header.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!empty($_SESSION['current_user'])) {
    // Thiết lập số lượng admin trên mỗi trang và phân trang
    $item_per_page = (!empty($_GET['per_page'])) ? (int)$_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    // Lấy tổng số admin
    $stmt = $con->prepare("SELECT COUNT(*) FROM `admin`");
    $stmt->execute();
    $stmt->bind_result($totalRecords);
    $stmt->fetch();
    $stmt->close();

    // Tính tổng số trang
    $totalPages = ceil($totalRecords / $item_per_page);

    // Truy vấn admin với phân trang
    $stmt = $con->prepare("SELECT * FROM `admin` ORDER BY `admin_id` DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $item_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $admins = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    ?>
    <div class="main-content">
        <h1>Thông tin cá nhân</h1>
        <div class="product-items">
            <div class="buttons">
                <a class="add_product" href="./admin_editing.php">Thêm admin</a>
            </div>
            <ul>
                <li class="product-item-heading">
                    <div class="product-prop product-name">Tên đăng nhập</div>
                    <div class="product-prop product-name">Tên đầy đủ</div> <!-- Thêm cột Tên đầy đủ -->
                    <div class="product-prop product-button">Sửa</div>
                    <div class="clear-both"></div>
                </li>
                <?php
                foreach ($admins as $row) {
                    ?>
                    <li>
                        <div class="product-prop product-name"><?= htmlspecialchars($row['username']) ?></div>
                        <div class="product-prop product-name"><?= htmlspecialchars($row['fullname']) ?></div> <!-- Hiển thị tên đầy đủ -->
                        <div class="product-prop product-button">
                            <a href="./admin_editing.php?id=<?= htmlspecialchars($row['admin_id']) ?>">Sửa</a>
                        </div>
                        <div class="clear-both"></div>
                    </li>
                <?php } ?>
            </ul>
            <div id="pagination">
                <!-- Gọi file phân trang ở đây -->
                <?php include './pagination.php'; ?>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
<?php
}
include 'footer.php';
?>

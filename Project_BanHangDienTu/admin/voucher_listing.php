<link rel="stylesheet" href="css/admin_style.css">
<?php
include 'header.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!empty($_SESSION['current_user'])) {
    // Thiết lập số lượng user trên mỗi trang và phân trang
    $item_per_page = (!empty($_GET['per_page'])) ? (int)$_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    // Lấy tổng số voucher
    $stmt = $con->prepare("SELECT COUNT(*) FROM `voucher`");
    $stmt->execute();
    $stmt->bind_result($totalRecords);
    $stmt->fetch();
    $stmt->close();

    // Tính tổng số trang
    $totalPages = ceil($totalRecords / $item_per_page);

    // Truy vấn user với phân trang
    $stmt = $con->prepare("SELECT * FROM `voucher` ORDER BY `id_voucher` DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $item_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $admins = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    ?>
    <div class="main-content">
        <h1>Danh sách Voucher</h1>
        <div class="product-items">
            <div class="buttons">
                <a class="add_product" href="./voucher_editing.php">Thêm voucher</a>
            </div>
            <ul>
                <li class="product-item-heading">
                    <div class="product-prop voucher-id">ID</div>
                    <div class="product-prop voucher-mota">Mô tả</div>
                    <div class="product-prop voucher-giagiam">Giá giảm</div>
                    <div class="product-prop voucher-ngaytao">Ngày tạo</div>
                    <div class="product-prop voucher-ngayhethan">Ngày hết hạn</div>
                    <div class="product-prop voucher-button">STT</div>
                    <div class="product-prop product-button">Sửa</div>
                    <div class="product-prop product-button">Xóa</div>
                    <div class="clear-both"></div>
                </li>
                <?php
                foreach ($admins as $row) {
                    ?>
                    <li>
                        <div class="product-prop voucher-id"><?= htmlspecialchars($row['id_voucher']) ?></div>
                        <div class="product-prop voucher-mota"><?= htmlspecialchars($row['mota']) ?></div>
                        <div class="product-prop product-giagiam"><?= htmlspecialchars($row['giagiam']) ?></div>
                        <div class="product-prop voucher-ngaytao"><?= date($row['ngaytao']) ?></div>
                        <div class="product-prop voucher-ngayhethan"><?= date($row['ngayhethan']) ?></div>
                        <div class="product-prop voucher-stt"><?= htmlspecialchars($row['stt']) ?></div>
                        <div class="product-prop product-button">
                            <a href="./voucher_editing.php?id=<?= htmlspecialchars($row['id_voucher']) ?>">Sửa</a>
                        </div>
                        
                        <div class="product-prop product-button">
                            <a href="./voucher_delete.php?id=<?= htmlspecialchars($row['id_voucher']) ?>">Xóa</a>
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

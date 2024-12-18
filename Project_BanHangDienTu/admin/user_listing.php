<link rel="stylesheet" href="css/admin_style.css">
<?php
include 'header.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!empty($_SESSION['current_user'])) {
    // Thiết lập số lượng user trên mỗi trang và phân trang
    $item_per_page = (!empty($_GET['per_page'])) ? (int)$_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    // Lấy tổng số user
    $stmt = $con->prepare("SELECT COUNT(*) FROM `users`");
    $stmt->execute();
    $stmt->bind_result($totalRecords);
    $stmt->fetch();
    $stmt->close();

    // Tính tổng số trang
    $totalPages = ceil($totalRecords / $item_per_page);

    // Truy vấn user với phân trang
    $stmt = $con->prepare("SELECT * FROM `users` ORDER BY `id` DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $item_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $admins = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    ?>
    <div class="main-content">
        <h1>Danh sách User</h1>
        <div class="product-items">
            <div class="buttons">
                <a class="add_product" href="./user_editing.php">Thêm user</a>
            </div>
            <ul>
                <li class="product-item-heading">
                    <div class="product-prop product-name">Email</div>
                    <div class="product-prop user-password">Mật khẩu</div>
                    <div class="product-prop product-name">Họ</div>
                    <div class="product-prop product-name">Tên</div>
                    <div class="product-prop product-button">Sửa</div>
                    <div class="product-prop product-button">Xóa</div>
                    <div class="clear-both"></div>
                </li>
                <?php
                foreach ($admins as $row) {
                    ?>
                    <li>
                        <div class="product-prop product-name"><?= htmlspecialchars($row['email']) ?></div>
                        <div class="product-prop user-password"><?= htmlspecialchars($row['password']) ?></div>
                        <div class="product-prop product-name"><?= htmlspecialchars($row['firstname']) ?></div>
                        <div class="product-prop product-name"><?= htmlspecialchars($row['lastname']) ?></div>
                        <div class="product-prop product-button">
                            <a href="./user_editing.php?id=<?= htmlspecialchars($row['id']) ?>">Sửa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./user_delete.php?id=<?= htmlspecialchars($row['id']) ?>">Xóa</a>
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

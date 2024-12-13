<div id="pagination">
    <style>
        #pagination {
            display: flex; /* căn giữa các phần tử */
            justify-content: center; /* Căn giữa các phần tử */
            margin: 20px 0; /* Khoảng cách trên và dưới */
        }

        .page-item {
            padding: 10px 15px; /* Khoảng cách bên trong cho các phần tử phân trang */
            margin: 0 5px; /* Khoảng cách giữa các phần tử phân trang */
            border: 1px solid #ccc; /* Đường viền cho các phần tử phân trang */
            text-decoration: none; /* Xóa gạch chân cho liên kết */
            color: #333;
        }

        .current-page {
            font-weight: bold; /* Đậm cho trang hiện tại */
            background-color: #f0f0f0; /* Màu nền cho trang hiện tại */
        }

        .page-item:hover {
            background-color: #e0e0e0; /* Màu nền khi hover vào các phần tử phân trang */
        }
    </style>

    <?php 
    // Nếu trang hiện tại lớn hơn 3, hiển thị liên kết đến trang đầu
    if ($current_page > 3) {
        $first_page = 1; ?>
        <a class="page-item" href="?per_page=<?= htmlspecialchars($item_per_page) ?>&page=<?= htmlspecialchars($first_page) ?>">First</a>
    <?php }

    // Nếu trang hiện tại lớn hơn 1, hiển thị liên kết đến trang trước
    if ($current_page > 1) {
        $prev_page = $current_page - 1; ?>
        <a class="page-item" href="?per_page=<?= htmlspecialchars($item_per_page) ?>&page=<?= htmlspecialchars($prev_page) ?>">Prev</a>
    <?php }

    // Vòng lặp để hiển thị số trang
    for ($num = 1; $num <= $totalPages; $num++) {
        // Nếu không phải là trang hiện tại
        if ($num != $current_page) {
            // Hiển thị số trang nếu trong khoảng 3 trang quanh trang hiện tại
            if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                <a class="page-item" href="?per_page=<?= htmlspecialchars($item_per_page) ?>&page=<?= htmlspecialchars($num) ?>"><?= htmlspecialchars($num) ?></a>
            <?php }
        } else { // Nếu là trang hiện tại
            ?>
            <strong class="current-page page-item"><?= htmlspecialchars($num) ?></strong> <!-- Đánh dấu trang hiện tại -->
        <?php }
    }

    // Nếu trang hiện tại nhỏ hơn tổng số trang, hiển thị liên kết đến trang tiếp theo
    if ($current_page < $totalPages) {
        $next_page = $current_page + 1; ?>
        <a class="page-item" href="?per_page=<?= htmlspecialchars($item_per_page) ?>&page=<?= htmlspecialchars($next_page) ?>">Next</a>
    <?php }

    // Nếu trang hiện tại nhỏ hơn tổng số trang trừ 3, hiển thị liên kết đến trang cuối
    if ($current_page < $totalPages - 3) {
        $end_page = $totalPages; ?>
        <a class="page-item" href="?per_page=<?= htmlspecialchars($item_per_page) ?>&page=<?= htmlspecialchars($end_page) ?>">Last</a>
    <?php } ?>
</div>

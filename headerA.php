<?php
// Bao gồm tệp kết nối cơ sở dữ liệu
require_once 'db.php';  // Đảm bảo đường dẫn đúng tới tệp db.php
?>

<?php
// Lấy thông tin người dùng từ CSDL
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} // Bắt đầu session nếu chưa

$user_id = $_SESSION['user_id'];  // Lấy user_id từ session
$cart_id = $_SESSION['cart_id'];

// Kiểm tra nếu user_id tồn tại
if (!isset($user_id)) {
    die("User ID không tồn tại. Vui lòng đăng nhập.");
}

// Truy vấn thông tin người dùng từ cơ sở dữ liệu
$stmt = $pdo->prepare("SELECT profile_image FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();

// Kiểm tra xem người dùng có ảnh đại diện hay không
$profile_image = !empty($user['profile_image']) && file_exists('uploads/' . $user['profile_image'])
    ? 'uploads/' . $user['profile_image']  // Nếu có ảnh, lấy đường dẫn tới ảnh
    : '/ZENTECH/Data/Image/ICONLOGOZ.png';  // Nếu không có ảnh, sử dụng ảnh mặc định

// Lấy thông tin giỏ hàng từ session
$cart_id = $_SESSION['cart_id'] ?? null;  // Nếu không có cart_id trong session, gán null

// Kiểm tra nếu cart_id tồn tại
if ($cart_id) {
    // Truy vấn tổng số lượng sản phẩm trong giỏ hàng
    $querycount = "SELECT SUM(quantity) AS count_cart FROM cart WHERE cart_id = :cart_id";
    $stmt = $pdo->prepare($querycount);
    $stmt->execute(['cart_id' => $cart_id]);

    $product = $stmt->fetch();
    $count_cart = $product['count_cart'] ?? 0;  // Nếu không có sản phẩm nào trong giỏ hàng, gán $count_cart = 0
} else {
    $count_cart = 0;  // Nếu không có cart_id, giỏ hàng trống
}
?>

<div class="header">
    <div class="header_inner">
        <a href="/ZENTECH/index.php"><img src="/ZENTECH/Data/Image/LOGO.png" alt="" class="header_logo"></a>
        <ul id="globalnav-list" class="globalnav-list">
            <li class="menu_item"> <a href="/ZENTECH/showsp.php?brand=iphone">
                    <p class="globalnav-list-content">iPhone</p>
                </a> </li>
            <li class="menu_item"> <a href="/ZENTECH/showsp.php?brand=samsung">
                    <p class="globalnav-list-content">Samsung</p>
                </a> </li>
            <li class="menu_item"> <a href="/ZENTECH/showsp.php?brand=xiaomi">
                    <p class="globalnav-list-content">Xiaomi</p>
                </a> </li>
            <li class="menu_item"> <a href="/ZENTECH/showsp.php?brand=oppo">
                    <p class="globalnav-list-content">Oppo</p>
                </a> </li>
            <li class="menu_item"> <a href="/ZENTECH/showsp.php?brand=accessories">
                    <p class="globalnav-list-content">Phụ kiện</p>
                </a> </li>
        </ul>

        <ul id="globalnav-tool" class="globalnav-tool">
            <li class="globalnav-tool-search">
                <img src="/ZENTECH/Data/Image/search.png" alt="Search Icon" class="icon">
                <div class="search_box">
                    <div class="search">
                        <input type="text" name="search" id="searchInput" placeholder="Nhập thông tin bạn muốn tìm kiếm vào đây" class="search_input" autocomplete="off">
                    </div>
                </div>
                <div class="relate_box" id="relateBox">
                    <div class="show_product_relate" id="productSuggestions">
                        <!-- Sản phẩm gợi ý sẽ được hiển thị tại đây thông qua JavaScript -->
                    </div>
                </div>
            </li>
            <script>
                document.getElementById("searchInput").addEventListener("input", function() {
                    const searchTerm = this.value;

                    if (searchTerm.length > 0) {
                        // Gửi yêu cầu AJAX đến server
                        const xhr = new XMLHttpRequest();
                        xhr.open("GET", `/ZENTECH/search_suggestions.php?search=${encodeURIComponent(searchTerm)}`, true);
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                // Cập nhật kết quả gợi ý vào HTML
                                document.getElementById("productSuggestions").innerHTML = xhr.responseText;
                            }
                        };
                        xhr.send();
                    } else {
                        // Xóa kết quả gợi ý nếu trường tìm kiếm rỗng
                        document.getElementById("productSuggestions").innerHTML = "";
                    }
                });
            </script>
            <li class="globalnav-tool-content"><a href="/ZENTECH/Quyen_GioHang/cart.php"><img src="/ZENTECH/DATA/Image/store.png" style="width: 40px; height: 40px;" alt="" class="icon-cart"></a><span style="font-size: 10px;" class="count-cart"> <?php echo $count_cart; ?></span></li>
            <li class="globalnav-tool-content">
                <!-- Hiển thị ảnh người dùng hoặc ảnh mặc định -->
                <img src="<?= htmlspecialchars($profile_image) ?>" alt="Ảnh đại diện" class="icon" width="100" height="100" style="border-radius: 50%; object-fit: cover;">
                <div class="setting_box">
                    <ul class="setting_properties">
                        <li><a href="/ZENTECH/profile.php">
                                <p>Xem thông tin</p>
                            </a></li>
                        <li><a href="/ZENTECH/logout.php">
                                <p>Đăng xuất</p>
                            </a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
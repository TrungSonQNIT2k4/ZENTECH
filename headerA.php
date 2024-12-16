<?php
// Kết nối cơ sở dữ liệu
require 'db.php';  // Chắc chắn rằng tệp db.php chứa kết nối PDO

// Lấy thông tin người dùng từ CSDL (bạn cần có session user_id trước đó)
session_start(); // Bắt đầu session nếu chưa
$user_id = $_SESSION['user_id'];  // Lấy user_id từ session

// Truy vấn thông tin người dùng từ cơ sở dữ liệu
$stmt = $pdo->prepare("SELECT profile_image FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();

// Kiểm tra xem người dùng có ảnh đại diện hay không
$profile_image = !empty($user['profile_image']) && file_exists('uploads/' . $user['profile_image'])
    ? 'uploads/' . $user['profile_image']  // Nếu có ảnh, lấy đường dẫn tới ảnh
    : '/ZENTECH/Data/Image/ICONLOGOZ.png';  // Nếu không có ảnh, sử dụng ảnh mặc định
?>
<div class="header">
    <div class="header_inner">
        <a href="/ZENTECH/index.php"><img src="/ZENTECH/Data/Image/LOGO.png" alt="" class="header_logo"></a>
        <ul id="globalnav-list" class="globalnav-list">
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">iPhone</p>
                </a>
                <div class="menu_child">
                    <div class="menu_child-item">
                        <h4>Khám phá iPhone</h4>
                        <ul class="menu_child-list">
                            <li><a href="">
                                    <p>iPhone 16</p>
                                </a></li>
                            <li><a href="">
                                    <p>iPhone 15</p>
                                </a></li>
                            <li><a href="">
                                    <p>iPhone 14</p>
                                </a></li>
                            <li><a href="">
                                    <p>iPhone 13</p>
                                </a></li>
                            <li><a href="">
                                    <p>iPhone 12</p>
                                </a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Dòng máy</h4>
                        <ul class="menu_child-list">
                            <li><a href="">
                                    <p>Pro Max</p>
                                </a></li>
                            <li><a href="">
                                    <p>Pro</p>
                                </a></li>
                            <li><a href="">
                                    <p>Plus</p>
                                </a></li>
                            <li><a href="">
                                    <p>Mini</p>
                                </a></li>
                            <li><a href="">
                                    <p>Thường</p>
                                </a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Khám phá phụ kiện iPhone</h4>
                        <ul class="menu_child-list">
                            <li><a href="">
                                    <p>Airpod</p>
                                </a></li>
                            <li><a href="">
                                    <p>Ốp lưng</p>
                                </a href=""></li>
                            <li><a href="">
                                    <p>MagSafe</p>
                                </a></li>
                            <li><a href="">
                                    <p>Sạc Apple chính hãng</p>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">Samsung</p>
                </a>
                <div class="menu_child">
                    <div class="menu_child-item">
                        <h4>Khám phá Samsung</h4>
                        <ul class="menu_child-list">
                            <li><a href="">
                                    <p>S series</p>
                                </a></li>
                            <li><a href="">
                                    <p>A series</p>
                                </a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Khám phá phụ kiện SamSung</h4>
                        <ul class="menu_child-list">
                            <li><a href="">
                                    <p>Galaxy Buds</p>
                                </a></li>
                            <li><a href="">
                                    <p>Sạc không dây</p>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">Xiaomi</p>
                </a>
                <div class="menu_child">
                    <div class="menu_child-item">
                        <h4>Khám phá Xiaomi</h4>
                        <ul class="menu_child-list">
                            <li><a href="">
                                    <p>Mi Series</p>
                                </a></li>
                            <li><a href="">
                                    <p>Mi Note Series</p>
                                </a></li>
                            <li><a href="">
                                    <p>Redmi Note Series</p>
                                </a></li>
                            <li><a href="">
                                    <p>Redmi Series</p>
                                </a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Khám phá phụ kiện Xiaomi</h4>
                        <ul class="menu_child-list">
                            <li><a href="">
                                    <p>Xiaomi 67W GaN Charger</p>
                                </a></li>
                            <li><a href="">
                                    <p>Dây cáp sạc</p>
                                </a></li>
                            <li><a href="">
                                    <p>Xiaomi True Wireless Earbuds</p>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">oppo</p>
                </a>
                <div class="menu_child">
                    <div class="menu_child-item">
                        <h4>Khám phá Oppo</h4>
                        <ul class="menu_child-list">
                            <li><a href="">
                                    <p>Find N Series</p>
                                </a></li>
                            <li><a href="">
                                    <p>Find X Series</p>
                                </a></li>
                            <li><a href="">
                                    <p>Reno Series</p>
                                </a></li>
                            <li><a href="">
                                    <p>A Series</p>
                                </a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Khám phá phụ kiện Oppo</h4>
                        <ul class="menu_child-list">
                            <li><a href="">
                                    <p>Super VOOC</p>
                                </a></li>
                            <li><a href="">
                                    <p>Dây cáp sạc</p>
                                </a></li>
                            <li></li><a href="">
                                <p>Sạc dự phòng Oppo</p>
                            </a>
            </li>
        </ul>
    </div>
</div>
</li>
<li class="menu_item">
    <a href="">
        <p class="globalnav-list-content">Phụ kiện</p>
    </a>
    <div class="menu_child">
        <div class="menu_child-item">
            <h4>Phụ kiện Smartphone</h4>
            <ul class="menu_child-list">
                <li><a href="">
                        <p>Ốp lưng</p>
                    </a></li>
                <li><a href="">
                        <p>Kính cường lực</p>
                    </a></li>
            </ul>
        </div>
        <div class="menu_child-item">
            <h4>Phụ kiện</h4>
            <ul class="menu_child-list">
                <li><a href="">
                        <p>Củ sạc</p>
                    </a></li>
                <li><a href="">
                        <p>Dây sạc</p>
                    </a></li>
                <li><a href="">
                        <p>Tai nghe</p>
                    </a></li>
                <li><a href="">
                        <p>Sạc dự phòng</p>
                    </a></li>
            </ul>
        </div>
    </div>
</li>
</ul>


<ul id="globalnav-tool" class="globalnav-tool">
    <li class="globalnav-tool-search">
        <img src="/ZENTECH/Data/Image/search.png" alt="Search Icon" class="icon">
        <div class="search_box">
            <div class="search">
                    <input type="text" name="search" id="searchInput"
                        placeholder="Nhập thông tin bạn muốn tìm kiếm vào đây" class="search_input" autocomplete="off">
            </div>
        </div>
        <div class="relate_box" id="relateBox">
            <div class="show_product_relate" id="productSuggestions">
                <!-- Sản phẩm gợi ý sẽ được hiển thị tại đây thông qua JavaScript -->
            </div>
        </div>
    </li>
    <script>
        document.getElementById("searchInput").addEventListener("input", function () {
            const searchTerm = this.value;

            if (searchTerm.length > 0) {
                // Gửi yêu cầu AJAX đến server
                const xhr = new XMLHttpRequest();
                xhr.open("GET", `/ZENTECH/search_suggestions.php?search=${encodeURIComponent(searchTerm)}`, true);
                xhr.onload = function () {
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
    <li class="globalnav-tool-content">
        <a href="/ZENTECH/Quyen_GioHang/cart.php"><img src="/ZENTECH/Data/Image/store.png" alt="" class="icon"></a>
    </li>
    <li class="globalnav-tool-content">
    <!-- Hiển thị ảnh người dùng hoặc ảnh mặc định -->
    <img src="<?= htmlspecialchars($profile_image) ?>" alt="Ảnh đại diện" class="icon" width="100" height="100" style="border-radius: 50%; object-fit: cover;">
    <div class="setting_box">
        <ul class="setting_properties">
            <li><a href="/ZENTECH/profile.php">
                    <p>Xem thông tin</p>
                </a></li>
            <li><a href="">
                    <p>Setting</p>
                </a></li>
        </ul>
    </div>
</li>

</ul>
</div>

</div>
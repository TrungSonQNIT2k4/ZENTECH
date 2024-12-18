<?php
// Bao gồm tệp kết nối cơ sở dữ liệu
require_once 'db.php';  // Đảm bảo đường dẫn đúng tới tệp db.php

// Bắt đầu session nếu chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Nội dung HTML sau khi truy vấn thành công -->
<div class="header">
    <div class="header_inner">
        <a href="/ZENTECH/index.php"><img src="/ZENTECH/Data/Image/LOGO.png" alt="" class="header_logo"></a>
        <ul id="globalnav-list" class="globalnav-list">
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">iPhone</p>
                </a>
            </li>
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">Samsung</p>
                </a>
            </li>
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">Xiaomi</p>
                </a>
            </li>
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">oppo</p>
                </a>
            </li>
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">Phụ kiện</p>
                </a>
            </li>
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
            <li class="globalnav-tool-content"><a href="/ZENTECH/login.php"><img src="/ZENTECH/DATA/Image/store.png" class="icon"></li>
            <li class="globalnav-tool-content">
                <!-- Hiển thị ảnh người dùng hoặc ảnh mặc định -->
                <a href="/ZENTECH/login.php"><img src="/ZENTECH/Data/Image/login.png" alt="" class="icon"></a>
            </li>
        </ul>
    </div>
</div>

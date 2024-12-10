<?php
// Lấy kết quả tìm kiếm từ Ajax request
if (isset($_POST['query'])) {
    $query = htmlspecialchars($_POST['query']);
    $sql = "SELECT name, description FROM product WHERE name LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
    exit();
}
?>
<div class="header">
    <div class="header_inner">
        <a href="home.html"><img src="/ZENTECH/Data/Image/LOGO.png" alt="" class="header_logo"></a>
        <ul id="globalnav-list" class="globalnav-list">
            <li class="menu_item">
                <a href="">
                    <p class="globalnav-list-content">iPhone</p>
                </a>
                <div class="menu_child">
                    <div class="menu_child-item">
                        <h4>Khám phá iPhone</h4>
                        <ul class="menu_child-list">
                            <li><a href=""><p>iPhone 16</p></a></li>
                            <li><a href=""><p>iPhone 15</p></a></li>
                            <li><a href=""><p>iPhone 14</p></a></li>
                            <li><a href=""><p>iPhone 13</p></a></li>
                            <li><a href=""><p>iPhone 12</p></a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Dòng máy</h4>
                        <ul class="menu_child-list">
                            <li><a href=""><p>Pro Max</p></a></li>
                            <li><a href=""><p>Pro</p></a></li>
                            <li><a href=""><p>Plus</p></a></li>
                            <li><a href=""><p>Mini</p></a></li>
                            <li><a href=""><p>Thường</p></a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Khám phá phụ kiện iPhone</h4>
                        <ul class="menu_child-list">
                            <li><a href=""><p>Airpod</p></a></li>
                            <li><a href=""><p>Ốp lưng</p></a href=""></li>
                            <li><a href=""><p>MagSafe</p></a></li>
                            <li><a href=""><p>Sạc Apple chính hãng</p></a></li>
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
                            <li><a href=""><p>S series</p></a></li>
                            <li><a href=""><p>A series</p></a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Khám phá phụ kiện SamSung</h4>
                        <ul class="menu_child-list">
                            <li><a href=""><p>Galaxy Buds</p></a></li>
                            <li><a href=""><p>Sạc không dây</p></a></li>
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
                            <li><a href=""><p>Mi Series</p></a></li>
                            <li><a href=""><p>Mi Note Series</p></a></li>
                            <li><a href=""><p>Redmi Note Series</p></a></li>
                            <li><a href=""><p>Redmi Series</p></a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Khám phá phụ kiện Xiaomi</h4>
                        <ul class="menu_child-list">
                            <li><a href=""><p>Xiaomi 67W GaN Charger</p></a></li>
                            <li><a href=""><p>Dây cáp sạc</p></a></li>
                            <li><a href=""><p>Xiaomi True Wireless Earbuds</p></a></li>
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
                            <li><a href=""><p>Find N Series</p></a></li>
                            <li><a href=""><p>Find X Series</p></a></li>
                            <li><a href=""><p>Reno Series</p></a></li>
                            <li><a href=""><p>A Series</p></a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Khám phá phụ kiện Oppo</h4>
                        <ul class="menu_child-list">
                            <li><a href=""><p>Super VOOC</p></a></li>
                            <li><a href=""><p>Dây cáp sạc</p></a></li>
                            <li></li><a href=""><p>Sạc dự phòng Oppo</p></a></li>
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
                            <li><a href=""><p>Ốp lưng</p></a></li>
                            <li><a href=""><p>Kính cường lực</p></a></li>
                        </ul>
                    </div>
                    <div class="menu_child-item">
                        <h4>Phụ kiện</h4>
                        <ul class="menu_child-list">
                            <li><a href=""><p>Củ sạc</p></a></li>
                            <li><a href=""><p>Dây sạc</p></a></li>
                            <li><a href=""><p>Tai nghe</p></a></li>
                            <li><a href=""><p>Sạc dự phòng</p></a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <ul id="globalnav-tool" class="globalnav-tool">
        <li class="globalnav-tool-search">
                <img src="/ZENTECH/Data/Image/search.png" alt="Search Icon" class="icon">
                <div class="search_box">
                    <ul class="search">
                        <li>
                            <input type="text" id="searchInput" placeholder="Nhập thông tin bạn muốn tìm kiếm vào đây" class="search_input">
                        </li>
                    </ul>
                </div>
                <div class="relate_box" id="relateBox">
                    <div class="show_product_relate">
                        <div class=""></div>
                    </div>
                </div>
            </li>
            <li class="globalnav-tool-content">
                <img src="/ZENTECH/Data/Image/store.png" alt="" class="icon">
            </li>
            <li class="globalnav-tool-content">
                <img src="/ZENTECH/Data/Image/ICONLOGOZ.png" alt="" class="icon">
                <div class="setting_box">
                    <ul class="setting_properties">
                        <li><a href=""><p>Xem thông tin</p></a></li>
                        <li><a href=""><p>Setting</p></a></li>
                    </ul>
                </div>
            </li>     
        </ul>         
    </div>

</div>
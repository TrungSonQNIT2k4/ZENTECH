<div class="container" id="container">
    <div class="banner">
        <button id="prevButton" class="banner-btn prev-btn"><img src="/ZENTECH/Data/Image/prev.png" alt=""></button>
        <div class="banner-wrapper">
            <?php
            // Kết nối cơ sở dữ liệu sử dụng PDO
            include 'db.php'; // Đảm bảo file này chứa kết nối PDO của bạn
            
            $sql = "SELECT * FROM banner ORDER BY RAND()";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Biến lưu trữ danh sách banner để truyền sang JavaScript
                $banners = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $banners[] = [
                        "link" => $row["link"],
                        "image_path" => $row["image_path"]
                    ];
                }

                // Chuyển đổi danh sách banner thành JSON
                echo '<script>const banners = ' . json_encode($banners) . ';</script>';
            } else {
                echo '<p>Không có banner nào.</p>';
            }
            ?>
            <div class="banner-content">
                <!-- Nội dung banner sẽ được cập nhật bằng JavaScript -->
                <a href="" id="bannerLink">
                    <img src="" alt="" id="bannerImage">
                </a>
            </div>
        </div>
        <button id="nextButton" class="banner-btn next-btn"><img src="/ZENTECH/Data/Image/next.png" alt=""></button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const bannerLink = document.getElementById("bannerLink");
            const bannerImage = document.getElementById("bannerImage");
            const prevButton = document.getElementById("prevButton");
            const nextButton = document.getElementById("nextButton");

            let currentIndex = 0;

            // Hàm hiển thị banner theo chỉ số
            const showBanner = (index) => {
                if (banners.length > 0) {
                    const banner = banners[index];
                    bannerLink.href = banner.link;
                    bannerImage.src = banner.image_path;
                }
            };

            // Xử lý khi nhấn nút "Prev"
            prevButton.addEventListener("click", () => {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : banners.length - 1;
                showBanner(currentIndex);
            });

            // Xử lý khi nhấn nút "Next"
            nextButton.addEventListener("click", () => {
                currentIndex = (currentIndex < banners.length - 1) ? currentIndex + 1 : 0;
                showBanner(currentIndex);
            });

            // Hiển thị banner đầu tiên
            showBanner(currentIndex);
        });
    </script>
</div>

<div class="recommend">
    <?php
    // Định nghĩa các truy vấn và điều kiện
    $categories = [
        ['name' => 'Dành cho bạn'],
    ];

    foreach ($categories as $category) {
        echo '<ul class="header-item">
        <li class="header-topic"><button><h3>' . $category['name'] . '</h3></button></li>
        <li>
            <div class="other-link">
                <button><a href=""><p>Xem tất cả</p></a></button>
            </div>
        </li>
      </ul>';

        echo '<div class="product-items-wrapper">';

        $sql = "SELECT * FROM products ORDER BY RAND()";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $count = 0;
            echo '<ul class="product-items">';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Dòng đầu tiên: hiển thị 4 sản phẩm
                if ($count < 4) {
                    echo '<li class="product-item">
                    <button>
                        <a href="/ZENTECH/Quyen_giohang/index-detail.php?id=' . $row["product_id"] . '">
                            <img src="' . $row["image_path"] . '" alt="">
                            <p>' . $row["name"] . '</p>
                            <p class="price">' . number_format($row["price"], 0, ',', '.') . ' VNĐ</p>
                        </a>
                    </button>
                  </li>';
                }

                // Dòng thứ hai: hiển thị 2 sản phẩm và 1 video ngẫu nhiên
                if ($count >= 4 && $count < 6) {
                    if ($count == 4) echo '</ul><ul class="product-items">';
                    echo '<li class="product-item">
                    <button>
                        <a href="/ZENTECH/Quyen_giohang/index-detail.php?id=' . $row["product_id"] . '">
                            <img src="' . $row["image_path"] . '" alt="">
                            <p>' . $row["name"] . '</p>
                            <p class="price">' . number_format($row["price"], 0, ',', '.') . ' VNĐ</p>
                        </a>
                    </button>
                  </li>';
                }

                if ($count == 6) {
                    // Truy vấn lấy đường dẫn video ngẫu nhiên
                    $video_sql = "SELECT video_path FROM videos ORDER BY RAND() LIMIT 1";
                    $video_stmt = $pdo->prepare($video_sql);
                    $video_stmt->execute();
                    $video_row = $video_stmt->fetch(PDO::FETCH_ASSOC);
                    $video_path = $video_row['video_path'];

                    echo '<li class="product-item">
                    <div class="video-container">
                        <video src="' . $video_path . '" autoplay loop muted class="adv"></video>
                    </div>
                  </li>';
                }

                $count++;
            }

            echo '</ul>';
        } else {
            echo '<p>Không có sản phẩm nào.</p>';
        }

        echo '</div>'; // Đóng wrapper
    }
    ?>
</div>

<div class="product">
    <?php
    // Định nghĩa các truy vấn và điều kiện
    $categories = [
        ['name' => 'APPLE', 'condition' => 'product_id > 100 AND product_id < 200'],
        ['name' => 'Samsung', 'condition' => 'product_id > 200 AND product_id < 300'],
        ['name' => 'Xiaomi', 'condition' => 'product_id > 300 AND product_id < 400'],
        ['name' => 'Oppo', 'condition' => 'product_id > 400 AND product_id < 500'],
        ['name' => 'Phụ kiện', 'condition' => 'product_id > 500 AND product_id < 600']
    ];

    foreach ($categories as $category) {
        echo '<ul class="header-item">
                <li class="header-topic"><button><h3>' . $category['name'] . '</h3></button></li>
                <li>
                    <div class="other-link">
                        <button><a href=""><p>Xem tất cả</p></a></button>
                    </div>
                </li>
              </ul>';
        echo '<ul class="product-items">';

        $sql = "SELECT * FROM products WHERE " . $category['condition'] . " ORDER BY RAND() LIMIT 4";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<li class="product-item">
                        <button>
                            <a href="/ZENTECH/Quyen_giohang/index-detail.php?id=' . $row["product_id"] . '">
                                <img src="' . $row["image_path"] . '" alt=""/>
                                <p>' . $row["name"] . '</p>
                                <p class="price">' . number_format($row["price"], 0, ',', '.') . ' VNĐ</p>
                            </a>
                        </button>
                      </li>';
            }
        } else {
            echo '<p>Không có sản phẩm nào.</p>';
        }

        echo '</ul>';
    }
    ?>
</div>

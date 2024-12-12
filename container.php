<div class="container" id="container">
    <div class="banner">
        <ul>
            <?php
            $conn = connectDatabase();
            $sql = "SELECT * FROM banner ORDER BY RAND() LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="banner-content">
                            <a href="' . $row["link"] . '">
                                <img src="' . $row["image_path"] . '" alt="">
                            </a>
                          </li>';
                }
            } else {
                echo '<p>Không có banner nào.</p>';
            }
            $conn->close();
            ?>
        </ul>
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

            $conn = connectDatabase();
            $sql = "SELECT * FROM products ORDER BY RAND()";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $count = 0; // Đếm tổng số mục
                echo '<ul class="product-items">';

                while ($row = $result->fetch_assoc()) {
                    // Dòng đầu tiên: hiển thị 4 sản phẩm
                    if ($count < 4) {
                        echo '<li class="product-item">
                        <button>
                            <img src="' . $row["image_path"] . '" alt="">
                            <p>' . $row["name"] . '</p>
                            <p class="price">' . number_format($row["price"], 0, ',', '.') . ' VNĐ</p>
                        </button>
                      </li>';
                    }

                    // Dòng thứ hai: hiển thị 2 sản phẩm và 1 video ngẫu nhiên
                    if ($count >= 4 && $count < 6) {
                        if ($count == 4) echo '</ul><ul class="product-items">'; // Đóng dòng trước đó và mở dòng mới
                        echo '<li class="product-item">
                        <button>
                            <img src="' . $row["image_path"] . '" alt="">
                            <p>' . $row["name"] . '</p>
                            <p class="price">' . number_format($row["price"], 0, ',', '.') . ' VNĐ</p>
                        </button>
                      </li>';
                    }

                    if ($count == 6) {
                        // Truy vấn lấy đường dẫn video ngẫu nhiên
                        $video_sql = "SELECT video_path FROM videos ORDER BY RAND() LIMIT 1";
                        $video_result = $conn->query($video_sql);
                        $video_row = $video_result->fetch_assoc();
                        $video_path = $video_row['video_path'];

                        echo '<li class="product-item">
                        <div class="video-container">
                            <video src="' . $video_path . '" autoplay loop muted class="adv"></video>
                        </div>
                      </li>';
                    }

                    // Dòng thứ ba: hiển thị 4 sản phẩm
                    if ($count >= 7 && $count < 11) {
                        if ($count == 7) echo '</ul><ul class="product-items">'; // Đóng dòng trước đó và mở dòng mới
                        echo '<li class="product-item">
                        <button>
                            <img src="' . $row["image_path"] . '" alt="">
                            <p>' . $row["name"] . '</p>
                            <p class="price">' . number_format($row["price"], 0, ',', '.') . ' VNĐ</p>
                        </button>
                      </li>';
                    }

                    // Dòng thứ tư: hiển thị 1 video ngẫu nhiên và 2 sản phẩm
                    if ($count == 11) {
                        echo '</ul><ul class="product-items">'; // Đóng dòng trước đó và mở dòng mới

                        // Truy vấn lấy đường dẫn video ngẫu nhiên
                        $video_sql = "SELECT video_path FROM videos ORDER BY RAND() LIMIT 1";
                        $video_result = $conn->query($video_sql);
                        $video_row = $video_result->fetch_assoc();
                        $video_path = $video_row['video_path'];

                        echo '<li class="product-item">
                        <div class="video-container">
                            <video src="' . $video_path . '" autoplay loop muted class="adv"></video>
                        </div>
                      </li>';
                    }

                    if ($count >= 12 && $count < 14) {
                        echo '<li class="product-item">
                        <button>
                            <img src="' . $row["image_path"] . '" alt="">
                            <p>' . $row["name"] . '</p>
                            <p class="price">' . number_format($row["price"], 0, ',', '.') . ' VNĐ</p>
                        </button>
                      </li>';
                    }

                    $count++;
                }

                echo '</ul>'; // Đóng dòng cuối cùng
            } else {
                echo '<p>Không có sản phẩm nào.</p>';
            }

            $conn->close();

            echo '</div>'; // Đóng wrapper
        }
        ?>
    </div>

    <div class="product">
        <?php
        // Định nghĩa các truy vấn và điều kiện
        $categories = [
            ['name' => 'APPLE', 'condition' => 'id > 100 AND id < 200'],
            ['name' => 'Samsung', 'condition' => 'id > 200 AND id < 300'],
            ['name' => 'Xiaomi', 'condition' => 'id > 300 AND id < 400'],
            ['name' => 'Oppo', 'condition' => 'id > 400 AND id < 500'],
            ['name' => 'Phụ kiện', 'condition' => 'id > 500 AND id < 600']
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

            $conn = connectDatabase();
            $sql = "SELECT * FROM products WHERE " . $category['condition'] . " ORDER BY RAND() LIMIT 4";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="product-item">
                            <button>
                                <img src="' . $row["image_path"] . '" alt="">
                                <p>' . $row["name"] . '</p>
                                <p class="price">' . number_format($row["price"], 0, ',', '.') . ' VNĐ</p>
                            </button>
                          </li>';
                }
            } else {
                echo '<p>Không có sản phẩm nào.</p>';
            }
            $conn->close();

            echo '</ul>';
        }
        ?>
    </div>
</div>

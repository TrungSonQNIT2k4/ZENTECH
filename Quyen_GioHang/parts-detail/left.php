<div class="scroll-box">
    <div class="left-info">
        <!-- ảnh sản phẩm -->
        <?php 
        include('show-image.php');
        $product_id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($product_id) {
            try {
                // Truy vấn chi tiết sản phẩm với PDO
                $query = "SELECT thongso , thuoctinh , mota, product_id , thongso.id_thongso 
                          FROM thongso
                          RIGHT JOIN thuoctinh ON thuoctinh.id_thongso = thongso.id_thongso
                          INNER JOIN motathuoctinh ON thuoctinh.id_thuoctinh = motathuoctinh.id_thuoctinh
                          WHERE product_id = :product_id";

                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->execute();
                
                // Truy vấn tên sản phẩm với PDO
                $querymain = "SELECT name FROM products WHERE product_id = :product_id";
                $stmtMain = $pdo->prepare($querymain);
                $stmtMain->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmtMain->execute();
                $product = $stmtMain->fetch(PDO::FETCH_ASSOC);

                if (!$product) {
                    echo "Sản phẩm không tồn tại.";
                    exit();
                }
            } catch(PDOException $e) {
                echo "Lỗi khi truy vấn sản phẩm: " . $e->getMessage();
                exit();
            }
        }
        ?>

        <!-- tới đây -->
        <div class="info-strikings">
            <ul class="info-strikings-list">
                <li><i class="ri-box-1-line"></i> Miễn phí vận chuyển toàn quốc</li>
                <li><i class="ri-shield-check-line"></i> Bảo hành 18 tháng chính hãng.</li>
                <li><i class="ri-box-1-line "></i> Bộ sản phẩm bao gồm: Thân máy, Củ sạc, Cáp USB Type C, Cây lấy SIM, Tài liệu HDSD.</li>
                <li><i class="ri-star-line "></i> 1 đổi 1 trong 30 ngày đầu nếu có lỗi phần cứng do nhà sản xuất.</li>
                <li><i class="ri-bookmark-line"></i> Giá đã bao gồm VAT</li>
            </ul>
        </div>

        <!-- địa chỉ còn hàng -->
        <?php include('address.php'); ?>

        <div class="info-product">
            <div class="title">
                <i class="ri-list-check"></i>
                thông tin sản phẩm
            </div>
            <div class="info-detail-product">
                <div class="info-description-product">
                    <h2>Bảng thông số kỹ thuật của <?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <table>
                    <?php 
                    if ($stmt->rowCount() > 0) {
                        $current_category = "";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Nếu danh mục thay đổi, thêm hàng tiêu đề mới
                            if ($current_category != $row['thongso']) {
                                $current_category = $row['thongso'];
                                echo ' <tr><th colspan=2>'. htmlspecialchars($current_category, ENT_QUOTES, 'UTF-8') . '</th></tr> ';
                            }
                            echo '<tr><td>' . htmlspecialchars($row['thuoctinh'], ENT_QUOTES, 'UTF-8') . '</td><td>' . htmlspecialchars($row['mota'], ENT_QUOTES, 'UTF-8') . '</td></tr>';
                        }
                    }
                    ?>      
                    </table>
                </div>                            
            </div>
        </div>
        <!-- tới đây -->
    </div>

    <div class="btn">
        <button class="toggle-button" onclick="toggleContent()">Xem thông số kĩ thuật <i class="ri-arrow-down-s-fill"></i></button>
    </div>
</div>

<!-- thông tin bên phải -->

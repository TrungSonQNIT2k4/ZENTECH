<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
?>
    <div class="main-content">
        <h1><?= !empty($_GET['id']) ? "Sửa sản phẩm" : "Thêm sản phẩm" ?></h1>
        <div id="content-box">
            <?php
            if (isset($_POST['name']) && isset($_POST['price'])) {
                // Xử lý thông tin sản phẩm
                $error = null;
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $name = $_POST['name'];
                $image_path = isset($_POST['image_path']) ? $_POST['image_path'] : ''; // Khởi tạo biến nếu không có
                $price = str_replace('.', '', $_POST['price']);
                $description = $_POST['description'];
                $timeNow = time();

                // Kiểm tra nếu không có file ảnh mới, giữ lại đường dẫn cũ
                if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
                    // Lưu ảnh mới
                    $image_path = '/path/to/images/' . $_FILES['image_file']['name']; // Cập nhật đường dẫn ảnh đúng
                    move_uploaded_file($_FILES['image_file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $image_path);
                } elseif (isset($_POST['old_image_path']) && !empty($_POST['old_image_path'])) {
                    // Nếu không có ảnh mới, giữ đường dẫn cũ
                    $image_path = $_POST['old_image_path'];
                }

                if (empty($name)) {
                    $error = "Bạn phải nhập tên sản phẩm.";
                } elseif (empty($price) || !is_numeric($price)) {
                    $error = "Giá sản phẩm không hợp lệ.";
                }

                if (empty($error)) {
                    if ($id) {
                        // Cập nhật sản phẩm
                        $stmt = $con->prepare("UPDATE `products` SET `name` = ?, `image_path` = ?, `price` = ?, `description` = ?, `updated_at` = ? WHERE `id` = ?");
                        $stmt->bind_param("ssssii", $name, $image_path, $price, $description, $timeNow, $id);
                    } else {
                        // Thêm sản phẩm mới
                        $stmt = $con->prepare("INSERT INTO `products` (`name`, `image_path`, `price`, `description`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssssii", $name, $image_path, $price, $description, $timeNow, $timeNow);
                    }

                    if ($stmt->execute()) {
                        // Hiển thị thông báo thành công và chuyển hướng về trang danh sách sản phẩm
                        echo "<script>
                                alert('Cập nhật thành công!');
                                window.location.href = 'product_listing.php';  // Quay lại trang danh sách sản phẩm
                              </script>";
                    } else {
                        $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                    }
                    $stmt->close();
                }
            }

            if (!empty($error)) {
                echo "<div class='error'>$error</div>";
            }

            // Lấy thông tin sản phẩm để chỉnh sửa
            $product = [];
            if (!empty($_GET['id'])) {
                $stmt = $con->prepare("SELECT * FROM `products` WHERE `id` = ?");
                $stmt->bind_param("i", $_GET['id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $product = $result->fetch_assoc();
                $stmt->close();
            }
            ?>
            <form id="product-form" method="POST" action="" enctype="multipart/form-data">
                <div class="wrap-field">
                    <label>ID: </label>
                    <input type="text" name="id" value="<?= htmlspecialchars(!empty($product['id']) ? $product['id'] : '') ?>" />
                    <div class="clear-both"></div>
                </div>
                <div class="wrap-field">
                    <label>Tên sản phẩm: </label>
                    <input type="text" name="name" value="<?= htmlspecialchars(!empty($product['name']) ? $product['name'] : '') ?>" />
                    <div class="clear-both"></div>
                </div>
                <!-- Đường dẫn hình ảnh -->
                <div class="wrap-field">
                    <label>Hình ảnh sản phẩm: </label>
                    <div class="right-wrap-field">
                        <?php if (!empty($product['image_path'])) { ?>
                            <!-- Hiển thị ảnh hiện tại -->
                            <img src="<?= htmlspecialchars($product['image_path']) ?>" alt="Ảnh sản phẩm" style="max-width: 150px;" /><br />
                            <!-- Hidden input lưu đường dẫn cũ -->
                            <input type="text" name="old_image_path" value="<?= htmlspecialchars($product['image_path']) ?>" readonly />
                        <?php } else { ?>
                            <!-- Nếu không có ảnh, không hiển thị ảnh -->
                            <p>Không có ảnh hiện tại</p>
                        <?php } ?>
                        <!-- Chọn ảnh mới -->
                        <input type="file" name="image_file" style="margin-left: 10px; margin-top: 5px" />
                    </div>
                    <div class="clear-both"></div>
                </div>
                <div class="wrap-field">
                    <label>Giá: </label>
                    <input type="text" name="price" value="<?= htmlspecialchars(!empty($product['price']) ? number_format($product['price'], 0, ',', '.') : '') ?>" />
                    <div class="clear-both"></div>
                </div>
                <div class="wrap-field">
                    <label>Mô tả: </label>
                    <textarea name="description"><?= htmlspecialchars(!empty($product['description']) ? $product['description'] : '') ?></textarea>
                    <div class="clear-both"></div>
                </div>
                <div class="wrap-field-button">
                    <button class="save_button_admin" type="submit">Lưu</button>
                </div>
                <div class="clear-both"></div>
            </form>
        </div>
    </div>
<?php
}
include './footer.php';
?>

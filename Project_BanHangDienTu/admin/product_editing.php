<link rel="stylesheet" href="css/admin_style.css">
<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy sản phẩm" : "Sửa sản phẩm") : "Thêm sản phẩm" ?></h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
                // Khai báo lỗi
                $error = null;

                // Kiểm tra thông tin sản phẩm
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
                    $galleryImages = [];
                    $img = '';

                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!is_numeric(str_replace('.', '', $_POST['price']))) {
                        $error = "Giá nhập không hợp lệ";
                    }

                    // Xử lý upload hình ảnh
                    if (isset($_FILES['img']) && !empty($_FILES['img']['name'][0])) {
                        $uploadedFiles = $_FILES['img'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $img = $result['path'];
                        }
                    }
                    if (empty($img) && !empty($_POST['img'])) {
                        $img = $_POST['img'];
                    }

                    // Xử lý thư viện ảnh
                    if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                        $uploadedFiles = $_FILES['gallery'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $galleryImages = $result['uploaded_files'];
                        }
                    }
                    if (!empty($_POST['gallery_image'])) {
                        $galleryImages = array_merge($galleryImages, $_POST['gallery_image']);
                    }

                    if (empty($error)) {
                        // Cập nhật hoặc thêm sản phẩm
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) {
                            $stmt = $con->prepare("UPDATE `product` SET `name` = ?, `img` = ?, `price` = ?, `content` = ?, `last_updated` = ? WHERE `id` = ?");
                            $price = str_replace('.', '', $_POST['price']);
                            $lastUpdated = time();
                            $stmt->bind_param("ssissi", $_POST['name'], $img, $price, $_POST['content'], $lastUpdated, $_GET['id']);
                        } else {
                            $stmt = $con->prepare("INSERT INTO `product` (`name`, `img`, `price`, `content`, `created_time`, `last_updated`) VALUES (?, ?, ?, ?, ?, ?)");
                            $price = str_replace('.', '', $_POST['price']);
                            $createdTime = time();
                            $stmt->bind_param("ssissi", $_POST['name'], $img, $price, $_POST['content'], $createdTime, $createdTime);
                        }

                        if (!$stmt->execute()) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } else {
                            // Thêm hình ảnh vào thư viện
                            if (!empty($galleryImages)) {
                                $product_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $stmt->insert_id;
                                $insertValues = [];
                                foreach ($galleryImages as $path) {
                                    $insertValues[] = "(NULL, ?, ?, ?, ?)";
                                }
                                $insertQuery = "INSERT INTO `image_library` (`id`, `product_id`, `path`, `created_time`, `last_updated`) VALUES " . implode(',', $insertValues);
                                $stmt = $con->prepare($insertQuery);
                                $timeNow = time();
                                $stmt->bind_param("issi", $product_id, $path, $timeNow, $timeNow);
                                foreach ($galleryImages as $path) {
                                    $stmt->execute();
                                }
                            }
                        }
                        $stmt->close();
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>
                <div class="container">
                    <div class="error"><?= isset($error) ? $error : "Cập nhật thành công!" ?></div>
                    <a href="product_listing.php">Quay lại</a>
                </div>
                <?php
            } else {
                // Nếu là trường hợp sửa hoặc xem sản phẩm
                if (!empty($_GET['id'])) {
                    $stmt = $con->prepare("SELECT * FROM `product` WHERE `id` = ?");
                    $stmt->bind_param("i", $_GET['id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $product = $result->fetch_assoc();

                    // Lấy thư viện ảnh
                    $stmt = $con->prepare("SELECT * FROM `image_library` WHERE `product_id` = ?");
                    $stmt->bind_param("i", $_GET['id']);
                    $stmt->execute();
                    $gallery = $stmt->get_result();

                    if ($gallery && $gallery->num_rows > 0) {
                        while ($row = $gallery->fetch_assoc()) {
                            $product['gallery'][] = [
                                'id' => $row['id'],
                                'path' => $row['path']
                            ];
                        }
                    }
                    $stmt->close();
                }
                ?>
                <form id="product-form" method="POST" action="<?= (!empty($product) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>" enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="Lưu" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên sản phẩm: </label>
                        <input type="text" name="name" value="<?= htmlspecialchars(!empty($product) ? $product['name'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Giá sản phẩm: </label>
                        <input type="text" name="price" value="<?= htmlspecialchars(!empty($product) ? number_format($product['price'], 0, ",", ".") : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Ảnh đại diện: </label>
                        <div class="right-wrap-field">
                            <?php if (!empty($product['img'])) { ?>
                                <img src="../<?= htmlspecialchars($product['img']) ?>" /><br/>
                                <input type="hidden" name="img" value="<?= htmlspecialchars($product['img']) ?>" />
                            <?php } ?>
                            <input type="file" name="img" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Thư viện ảnh: </label>
                        <div class="right-wrap-field">
                            <?php if (!empty($product['gallery'])) { ?>
                                <ul>
                                    <?php foreach ($product['gallery'] as $image) { ?>
                                        <li>
                                            <img src="../<?= htmlspecialchars($image['path']) ?>" />
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                            <?php if (isset($_GET['task']) && !empty($product['gallery'])) { ?>
                                <?php foreach ($product['gallery'] as $image) { ?>
                                    <input type="hidden" name="gallery_image[]" value="<?= htmlspecialchars($image['path']) ?>" />
                                <?php } ?>
                            <?php } ?>
                            <input multiple="" type="file" name="gallery[]" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Nội dung: </label>
                        <textarea name="content" id="product-content"><?= htmlspecialchars(!empty($product) ? $product['content'] : "") ?></textarea>
                        <div class="clear-both"></div>
                    </div>
                </form>
                <div class="clear-both"></div>
                <script>
                    CKEDITOR.replace('product-content');
                </script>
    <?php } ?>
        </div>
    </div>

    <?php
}
include './footer.php';
?>

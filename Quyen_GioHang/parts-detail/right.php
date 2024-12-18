<?php
include('connect.php'); // Kết nối cơ sở dữ liệu với PDO

// Lấy giá trị từ session
$user_id = $_SESSION["user_id"] ?? null;
$cart_id = $_SESSION["cart_id"] ?? null;
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($product_id) {
    // Truy vấn sản phẩm
    $query = "SELECT * FROM products WHERE product_id = :product_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Truy vấn phiên bản sản phẩm
    $queryver = "SELECT products.product_id, version.product_id, version_id , version 
                 FROM products 
                 INNER JOIN version ON version.product_id = products.product_id 
                 WHERE products.product_id = :product_id";
    $stmtver = $pdo->prepare($queryver);
    $stmtver->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmtver->execute();
    $resultver = $stmtver->fetchAll(PDO::FETCH_ASSOC);

    // Truy vấn màu sắc
    $queryco = "SELECT products.product_id, color, img_url, code_color.color_id 
                FROM products 
                INNER JOIN color_image ON color_image.product_id = products.product_id 
                INNER JOIN code_color ON color_image.color_id = code_color.color_id
                WHERE products.product_id = :product_id";
    $stmtco = $pdo->prepare($queryco);
    $stmtco->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmtco->execute();
    $resultco = $stmtco->fetchAll(PDO::FETCH_ASSOC);

    // Truy vấn thông số kỹ thuật
    $queryts = "SELECT thongso , thuoctinh , mota, product_id , thongso.id_thongso 
                FROM thongso
                RIGHT JOIN thuoctinh ON thuoctinh.id_thongso = thongso.id_thongso
                INNER JOIN motathuoctinh ON thuoctinh.id_thuoctinh = motathuoctinh.id_thuoctinh
                WHERE product_id = :product_id AND is_highlight = '1'";
    $stmtts = $pdo->prepare($queryts);
    $stmtts->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmtts->execute();
    $resultts = $stmtts->fetchAll(PDO::FETCH_ASSOC);

    // Truy vấn voucher
    $queryv = "SELECT * from voucher WHERE product_id = :product_id";
    $stmtv = $pdo->prepare($queryv);
    $stmtv->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmtv->execute();
    $resultv = $stmtv->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_POST['add-cart']) && $_POST['add-cart'] === 'add-cart') {
    $version = $_POST['version'] ?? null;
    $color = $_POST['color'] ?? null;
    if ($user_id && $cart_id) {
        if ($version && $color) {
            // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
            $check = "SELECT * FROM cart 
                      WHERE cart_id = :cart_id
                      AND user_id = :user_id
                      AND product_id = :product_id
                      AND color_id = :color_id
                      AND version_id = :version_id";
            $stmtcheck = $pdo->prepare($check);
            $stmtcheck->bindParam(':cart_id', $cart_id);
            $stmtcheck->bindParam(':user_id', $user_id);
            $stmtcheck->bindParam(':product_id', $product_id);
            $stmtcheck->bindParam(':color_id', $color);
            $stmtcheck->bindParam(':version_id', $version);
            $stmtcheck->execute();

            if ($stmtcheck->rowCount() > 0) {
                // Cập nhật số lượng sản phẩm trong giỏ hàng
                $update = "UPDATE cart SET quantity = quantity + 1 
                           WHERE cart_id = :cart_id
                           AND user_id = :user_id
                           AND product_id = :product_id
                           AND color_id = :color_id
                           AND version_id = :version_id";
                $stmtupdate = $pdo->prepare($update);
                $stmtupdate->bindParam(':cart_id', $cart_id);
                $stmtupdate->bindParam(':user_id', $user_id);
                $stmtupdate->bindParam(':product_id', $product_id);
                $stmtupdate->bindParam(':color_id', $color);
                $stmtupdate->bindParam(':version_id', $version);
            } else {
                // Thêm sản phẩm mới vào giỏ hàng
                $query = "INSERT INTO cart(cart_id, user_id, product_id, color_id, version_id, quantity) 
                          VALUES(:cart_id, :user_id, :product_id, :color_id, :version_id, 1)";
                $stmtinsert = $pdo->prepare($query);
                $stmtinsert->bindParam(':cart_id', $cart_id);
                $stmtinsert->bindParam(':user_id', $user_id);
                $stmtinsert->bindParam(':product_id', $product_id);
                $stmtinsert->bindParam(':color_id', $color);
                $stmtinsert->bindParam(':version_id', $version);

                if ($stmtinsert->execute()) {
                    echo "<script>alert('Thêm vào giỏ hàng thành công!');
                    location.reload();</script>";
                } else {
                    echo "<script>alert('Lỗi khi thêm vào giỏ hàng: " . $pdo->errorInfo() . "');</script>";
                }
            }
        } else {
            echo "<script>alert('Vui lòng chọn màu sắc và phiên bản!');</script>";
        }
    } else {
        echo "<script>alert('Bạn phải đăng nhập trước khi thêm sản phẩm vào giỏ hàng!');</script>";
    }
}

function format_currency($number) {
    return number_format($number, 0, ',', '.') . ' đ';
}
?>


<!-- Hiển thị thông tin sản phẩm, phiên bản, màu sắc và thêm vào giỏ hàng -->
<div class="right-info">
    <!-- Giá tiền -->
    <div class="top-detail">
        <div class="price-normal">
            <?php echo format_currency($product['price']); ?>đ
        </div>
    </div>

    <!-- Lựa chọn phiên bản -->
    <form method="POST" action="">
        <input type="hidden" id="selected-version" name="version" value="">
        <input type="hidden" id="selected-color" name="color" value="">

        <div class="version-section">
            <div class="title-version">Lựa chọn phiên bản</div>
            <div class="list-version">
                <?php
                // Kiểm tra nếu $resultver có dữ liệu
                if (isset($resultver) && $resultver) {
                    foreach ($resultver as $row) {
                        echo '<div class="version-for-feature" data-value="' . $row['version_id'] . '">' . $row['version'] . ' <i class="ri-check-line"></i> </div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="version-section">
            <div class="title-version">Lựa chọn màu</div>
            <div class="list-version">
                <?php
                // Kiểm tra nếu $resultco có dữ liệu
                if (isset($resultco) && $resultco) {
                    foreach ($resultco as $row) {
                        echo '<button onclick="image(' . $row['color_id'] . ')" type="button" class="box-color" data-value="' . $row['color_id'] . '" value="color_id" name="color_id">
                            <div class="image-bt"><img src="' . $row['img_url'] . '" alt="" /></div>
                            <p>' . $row['color'] . '</p> <i class="ri-check-line"></i>
                        </button>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="button-product">
            <button type="submit" name="submit" class="registration">
                <div class="tittle-section">
                    Mua ngay
                </div>
                <div class="sub-title">(Giao tận nhà hoặc nhận tại cửa hàng)</div>
            </button>
            <button type="submit" name="add-cart" class="cart" value="add-cart">
                <i class="ri-shopping-cart-fill"></i>
                <div class="add-cart">Thêm giỏ hàng</div>
            </button>
        </div>

        <!-- Thông số kỹ thuật -->
        <div class="specifications-box">
            <div class="box-title">
                <div class="specifications"><i class="ri-verified-badge-line"></i>
                    Thông số kỹ thuật
                </div>
                <div class="box-description">
                    <ul class="description">
                        <?php
                        if (isset($resultts) && $resultts) {
                            foreach ($resultts as $row) {
                                echo '<li><strong>' . $row['thuoctinh'] . '</strong><span>' . $row['mota'] . '</span></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// JavaScript for selecting version and color
document.addEventListener('DOMContentLoaded', () => {
    const versionElements = document.querySelectorAll('.version-for-feature');
    const colorElements = document.querySelectorAll('.box-color');
    const selectedVersionInput = document.getElementById('selected-version');
    const selectedColorInput = document.getElementById('selected-color');
    const mainImage = document.getElementById('main-image');

    // Xử lý chọn phiên bản
    versionElements.forEach(el => {
        el.addEventListener('click', () => {
            versionElements.forEach(item => item.classList.remove('selected'));
            el.classList.add('selected');
            selectedVersionInput.value = el.dataset.value;
        });
    });

    // Xử lý chọn màu
    colorElements.forEach(el => {
        el.addEventListener('click', () => {
            colorElements.forEach(item => item.classList.remove('selected'));
            el.classList.add('selected');
            selectedColorInput.value = el.dataset.value;

            const colorImageSrc = el.querySelector('img').getAttribute('src');
            mainImage.setAttribute('src', colorImageSrc);
        });
    });
});
</script>

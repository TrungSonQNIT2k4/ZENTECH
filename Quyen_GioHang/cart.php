<?php
session_start();
require_once 'connect.php';

// Giả sử user_id và cart_id được lưu trong session
$user_id = $_SESSION["user_id"] ?? null;
$cart_id = $_SESSION["cart_id"] ?? null;

// Khởi tạo biến tổng
$tong = 0;

try {
    // Truy vấn thông tin giỏ hàng
    $sql = "SELECT cart.user_id, cart.cart_id, cart.product_id, img_url, 
            cart.version_id, cart.color_id, products.name, color, version, price, 
            cart.quantity, (cart.quantity * price) AS tamtinh 
            FROM cart
            INNER JOIN products ON cart.product_id = products.product_id 
            INNER JOIN code_color ON cart.color_id = code_color.color_id 
            INNER JOIN color_image ON code_color.color_id = color_image.color_id
            INNER JOIN version ON color_image.product_id = version.product_id  
            WHERE cart.cart_id = :cart_id AND cart.version_id = version.version_id 
            GROUP BY cart.user_id, cart.cart_id, products.product_id, cart.version_id, cart.color_id, 
            products.name, version.version_id;";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi lấy thông tin giỏ hàng: " . $e->getMessage());
}

// Xử lý hành động delete, increase, decrease
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $product_id = $_GET['product_id'] ?? null;
    $color_id = $_GET['color_id'] ?? null;
    $version_id = $_GET['version_id'] ?? null;

    try {
        if ($action === 'delete') {
            $query = "DELETE FROM cart 
                      WHERE cart_id = :cart_id 
                      AND product_id = :product_id 
                      AND color_id = :color_id 
                      AND version_id = :version_id
                      AND user_id = :user_id";
        } elseif ($action === 'increase') {
            $query = "UPDATE cart 
                      SET quantity = quantity + 1 
                      WHERE cart_id = :cart_id 
                      AND product_id = :product_id 
                      AND color_id = :color_id 
                      AND version_id = :version_id 
                      AND user_id = :user_id";
        } elseif ($action === 'decrease') {
            $query = "UPDATE cart SET quantity = quantity - 1 
                      WHERE cart_id = :cart_id 
                      AND product_id = :product_id 
                      AND color_id = :color_id 
                      AND version_id = :version_id
                      AND user_id = :user_id
                      AND quantity > 1"; // Thêm điều kiện để không giảm dưới 1
        }

        if (isset($query)) {
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_STR);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
            $stmt->bindParam(':color_id', $color_id, PDO::PARAM_STR);
            $stmt->bindParam(':version_id', $version_id, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->execute();
            header("Location: cart.php?status=success");  // Điều hướng lại trang với thông báo thành công
            exit();
        }
    } catch (PDOException $e) {
        die("Lỗi khi xử lý hành động: " . $e->getMessage());
    }
}

// Hàm định dạng tiền tệ
function format_currency($number)
{
    return number_format($number, 0, ',', '.') . ' đ';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="icon" href="/ZENTECH/Data/Image/ICONLOGOZ.png">
    <link href="assets/css/style-cart.css" rel="stylesheet" />
    <link rel="stylesheet" href="/ZENTECH/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    <section>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ZENTECH/headerA.php'); ?>
        <div class="container">
            <div class="cart-product">
                <!-- Phần bên trái -->
                <div class="left">
                    <div class="head" onclick="goBackWithParams()" style="cursor: pointer;">
                        <div class="icon">
                            <i class="ri-arrow-left-s-line"></i>
                        </div>
                        <span class="text"> Quay lại</span>
                    </div>
                    <script>
                        function goBackWithParams() {
                            const urlParams = new URLSearchParams(window.location.search);
                            if (urlParams.has('?id=$product_id')) {
                                window.history.back();
                            } else {
                                window.history.back();
                            }
                        }
                    </script>
                    <div class="box-table">
                        <table>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Thuộc tính</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tạm tính</th>
                            </tr>
                            <?php if (!empty($result)) : ?>
                                <?php foreach ($result as $row) : 
                                    $tong += $row['tamtinh']; ?>
                                    <tr>
                                        <td>
                                            <div class="flex">
                                                <a href="cart.php?action=delete&product_id=<?= $row['product_id']; ?>&cart_id=<?= $row['cart_id']; ?>&color_id=<?= $row['color_id']; ?>&version_id=<?= $row['version_id']; ?>"><div class="delete-product">Xóa</div></a>
                                                <div class="image-product">
                                                    <img src="<?= $row['img_url']; ?>" alt="" />
                                                </div>
                                                <div class="name"><?= htmlspecialchars($row['name']); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="color"><?= htmlspecialchars($row['color']); ?></div>
                                            <div class="version"><?= htmlspecialchars($row['version']); ?></div>
                                        </td>
                                        <td>
                                            <div class="price"><?= format_currency($row['price']); ?></div>
                                        </td>
                                        <td>
                                            <div class="count">
                                                <a href="cart.php?action=decrease&product_id=<?= $row['product_id']; ?>&cart_id=<?= $row['cart_id']; ?>&color_id=<?= $row['color_id']; ?>&version_id=<?= $row['version_id']; ?>" class="decrease" style="<?= $row['quantity'] <= 1 ? 'pointer-events: none; opacity: 0.5;' : ''; ?>">-</a>
                                                <div class="quantity"><?= $row['quantity']; ?></div>
                                                <a href="cart.php?action=increase&product_id=<?= $row['product_id']; ?>&cart_id=<?= $row['cart_id']; ?>&color_id=<?= $row['color_id']; ?>&version_id=<?= $row['version_id']; ?>" class="increase">+</a>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="price"><?= format_currency($row['tamtinh']); ?></div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr><td colspan="5">Giỏ hàng trống.</td></tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>

                <!-- Phần bên phải -->
                <div class="right">
                    <p class="title">Cộng giỏ hàng</p>
                    <div class="flex">
                        <p>Tạm tính</p>
                        <span><?= format_currency($tong); ?></span>
                    </div>
                    <div class="flex">
                        <p>Tổng</p>
                        <span><?= format_currency($tong); ?></span>
                    </div>
                    <button class="thanhtoan">Tiến hành thanh toán</button>
                </div>
            </div>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ZENTECH/footer.php'); ?>
    </section>

    <!-- Hiển thị thông báo thành công nếu có -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
        <script>
            alert('Cập nhật thành công!');
        </script>
    <?php endif; ?>
</body>
</html>

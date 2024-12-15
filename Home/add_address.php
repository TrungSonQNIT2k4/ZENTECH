<?php
require 'connect_db.php';
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $address_type = $_POST['address_type'];
    $province = trim($_POST['province']);
    $district = trim($_POST['district']);
    $ward = trim($_POST['ward']);
    $specific_address = trim($_POST['specific_address']);

    // Kiểm tra dữ liệu cơ bản
    if (empty($name) || empty($phone) || empty($province) || empty($district) || empty($ward) || empty($specific_address)) {
        $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin.";
        header('Location: add_address.php');
        exit;
    }

    // Chuẩn bị câu lệnh SQL để kiểm tra trùng lặp (nếu cần kiểm tra)
    $check_stmt = $pdo->prepare("
        SELECT id FROM addresses 
        WHERE user_id = :user_id AND name = :name AND phone = :phone 
          AND province = :province AND district = :district AND ward = :ward 
          AND specific_address = :specific_address
    ");
    $check_stmt->execute([
        ':user_id' => $user_id,
        ':name' => $name,
        ':phone' => $phone,
        ':province' => $province,
        ':district' => $district,
        ':ward' => $ward,
        ':specific_address' => $specific_address,
    ]);

    if ($check_stmt->rowCount() > 0) {
        $_SESSION['message'] = "Địa chỉ này đã tồn tại!";
        header('Location: add_address.php');
        exit;
    }

    // Thêm địa chỉ mới
    $insert_stmt = $pdo->prepare("
        INSERT INTO addresses (user_id, name, phone, address_type, province, district, ward, specific_address) 
        VALUES (:user_id, :name, :phone, :address_type, :province, :district, :ward, :specific_address)
    ");

    try {
        $insert_stmt->execute([
            ':user_id' => $user_id,
            ':name' => $name,
            ':phone' => $phone,
            ':address_type' => $address_type,
            ':province' => $province,
            ':district' => $district,
            ':ward' => $ward,
            ':specific_address' => $specific_address,
        ]);
        $_SESSION['message'] = "Thêm địa chỉ mới thành công!";
    } catch (PDOException $e) {
        $_SESSION['message'] = "Lỗi khi thêm địa chỉ: " . $e->getMessage();
    }

    header('Location: add_address.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Pro5-Login&register/assets/profile.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/order_all.css">
    <link rel="stylesheet" href="/style.css">
    <title>Thêm Địa Chỉ</title>
</head>
<body>
<?php include ("/ZENTECH/headerA.php") ?>
<?php include 'templates/sidebar.php'; ?>

    <section class="main-content">
        <?php if (isset($_SESSION['message'])): ?>
            <script>
                alert("<?= $_SESSION['message']; ?>");
            </script>
            <?php unset($_SESSION['message']); // Xóa thông báo khỏi session ?>
        <?php endif; ?>

        <h1>Thêm Địa Chỉ Mới</h1>
        <form method="POST" action="" class="form">
            <div class="just-form">
                <div class="input-container">
                    <label>Họ Tên:</label>
                    <input type="text" name="name" required><br>
                </div>
                <div class="input-container">
                    <label>Số Điện Thoại:</label>
                    <input type="text" name="phone" required><br>
                </div>
                <div class="input-container">
                    <label>Loại Địa Chỉ:</label>
                    <select name="address_type" required>
                        <option value="Home">Nhà Riêng</option>
                        <option value="Office">Văn Phòng</option>
                    </select><br>
                </div>
                <div class="input-container">
                    <label>Tỉnh/Thành Phố:</label>
                    <input type="text" name="province" required><br>
                </div>
                <div class="input-container">
                    <label>Quận/Huyện:</label>
                    <input type="text" name="district" required><br>
                </div>
                <div class="input-container">
                    <label>Phường/Xã:</label>
                    <input type="text" name="ward" required><br>
                </div>
                <div class="input-container">
                    <label>Địa Chỉ Cụ Thể:</label>
                    <textarea name="specific_address" required></textarea><br>
                </div>
            </div>

            <div class="full-width">
                <div class="button-container">
                    <button type="submit">Hoàn Thành</button>
                </div>
            </div>
            <a href="index.php">Trở Lại</a>
        </form>
        <?php include ("/ZENTECH/Home/footer.php") ?>
    </section>
</body>
</html>

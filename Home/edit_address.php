<?php
session_start();
require 'connect_db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$address_id = $_GET['id'] ?? null;

if (!$address_id) {
    header('Location: list_addresses.php?error=Địa chỉ không tồn tại');
    exit;
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Lấy thông tin địa chỉ cụ thể
$stmt = $pdo->prepare("SELECT * FROM addresses WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $address_id, 'user_id' => $_SESSION['user_id']]);
$address = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$address) {
    header('Location: list_addresses.php?error=Địa chỉ không hợp lệ');
    exit;
}

// Xử lý cập nhật địa chỉ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address_type = $_POST['address_type'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $specific_address = $_POST['specific_address'];

    $stmt = $pdo->prepare("UPDATE addresses SET name = :name, phone = :phone, address_type = :address_type, province = :province, district = :district, ward = :ward, specific_address = :specific_address WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'name' => $name,
        'phone' => $phone,
        'address_type' => $address_type,
        'province' => $province,
        'district' => $district,
        'ward' => $ward,
        'specific_address' => $specific_address,
        'id' => $address_id,
        'user_id' => $_SESSION['user_id']
    ]);
    
    echo "<script>alert('Cập nhật địa chỉ thành công!'); window.location='list_addresses.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets-K/edit_address.css">
    <title>Chỉnh Sửa Địa Chỉ</title>
</head>
<body>
    <form method="POST" class="form">
        <div class="just-form">
            <div class="input-container">
                <label>Tên:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($address['name']); ?>" required>
            </div>
            <div class="input-container">
                <label>Số điện thoại:</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($address['phone']); ?>" required>
            </div>
            <div class="input-container">
                <label>Loại địa chỉ:</label>
                    <select name="address_type" required>
                        <option value="Home" <?= $address['address_type'] == 'Home' ? 'selected' : ''; ?>>Nhà Riêng</option>
                        <option value="Office" <?= $address['address_type'] == 'Office' ? 'selected' : ''; ?>>Văn Phòng</option>
                    </select><br>
            </div>
            <div class="input-container">
                <label>Tỉnh/Thành phố:</label>
                <input type="text" name="province" value="<?= htmlspecialchars($address['province']); ?>" required>
            </div>
            <div class="input-container">
                <label>Quận/Huyện:</label>
                <input type="text" name="district" value="<?= htmlspecialchars($address['district']); ?>" required>
            </div>
            <div class="input-container">
                <label>Phường/Xã:</label>
                <input type="text" name="ward" value="<?= htmlspecialchars($address['ward']); ?>" required>
            </div>
            <div class="input-container">
                <label>Địa chỉ cụ thể:</label>
                <textarea name="specific_address" required><?= htmlspecialchars($address['specific_address']); ?></textarea>
            </div>
                
        </div>

        <div class="full-width">
            <div class="button-container">
                <button type="submit">Cập Nhật</button>
                <a href="index.php">Trở Lại</a>
            </div>
        </div>
        
    </form>
</body>
</html>

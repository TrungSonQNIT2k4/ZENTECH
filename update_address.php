<?php
// Cấu hình kết nối cơ sở dữ liệu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Lấy ID người dùng từ session
$user_id = $_SESSION['user_id'];

$sql = "SELECT id, name, phone, province, district, ward, specific_address FROM addresses WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kiểm tra nếu người dùng đã chọn địa chỉ và gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['address_id'])) {
    $address_id = $_POST['address_id'];

    // Truy vấn để lấy thông tin địa chỉ đã chọn
    $address_sql = "SELECT * FROM addresses WHERE user_id = :user_id AND id = :address_id";
    $address_stmt = $pdo->prepare($address_sql);
    $address_stmt->execute(['user_id' => $user_id, 'address_id' => $address_id]);
    $selected_address = $address_stmt->fetch(PDO::FETCH_ASSOC);

    // Lưu thông tin địa chỉ đã chọn vào session để hiển thị trên trang chính
    $_SESSION['selected_address'] = $selected_address;

    // Chuyển hướng về trang chủ hoặc trang bạn muốn sau khi cập nhật
    header('Location: pay_product.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Địa Chỉ Nhận Hàng Mới</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Container to hold all cards */
        .address-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        /* Card styling */
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 600px;
            transition: transform 0.3s ease;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card input[type="radio"] {
            margin-right: 20px;
        }

        .card .address-info {
            flex-grow: 1;
        }

        .card .address-info h3 {
            font-size: 1.2em;
            margin: 0;
            color: #333;
        }

        .card .address-info p {
            margin: 5px 0;
            color: #555;
        }

        /* Submit button styling */
        .submit-btn {
            display: block;
            background-color: #4CAF50;
            color: white;
            font-size: 1em;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            max-width: 200px;
            margin-top: 20px;
            text-align: center;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Chọn Địa Chỉ Nhận Hàng Mới</h1>
    <div class="address-container">
        <form action="update_address.php" method="POST">
            <?php foreach ($addresses as $address): ?>
                <div class="card">
                    <input type="radio" name="address_id" value="<?= $address['id']; ?>" id="address_<?= $address['id']; ?>" required>
                    <label for="address_<?= $address['id']; ?>">
                        <div class="address-info">
                            <h3><?= htmlspecialchars($address['name']); ?></h3>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($address['phone']); ?></p>
                            <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($address['province'] . ' ' . $address['district'] . ' ' . $address['ward'] . ' ' . $address['specific_address']); ?></p>
                        </div>
                    </label>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="submit-btn">Chọn Địa Chỉ</button>
        </form>
    </div>
</body>
</html>



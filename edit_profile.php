<?php
session_start();
require 'db.php';

// Kiểm tra người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Bật chế độ lỗi PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Lấy thông tin người dùng hiện tại
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT firstname, lastname, email, phone, address, profile_image FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Không tìm thấy thông tin người dùng.";
    exit;
}

$upload_error = ''; // Biến lưu thông báo lỗi

// Xử lý cập nhật thông tin và tải ảnh
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    try {
        // Kiểm tra email trùng lặp (ngoại trừ email hiện tại của người dùng)
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :id");
        $stmt->execute(['email' => $email, 'id' => $user_id]);
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email đã tồn tại! Vui lòng chọn email khác.'); window.location='index-K.php';</script>";
            exit;
        }

        // Xử lý ảnh đại diện nếu có
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
            // Lấy thông tin tệp ảnh
            $file_tmp = $_FILES['profile_image']['tmp_name'];
            $file_name = $_FILES['profile_image']['name'];
            $file_size = $_FILES['profile_image']['size'];
            $file_error = $_FILES['profile_image']['error'];
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Kiểm tra lỗi tải ảnh
            if ($file_error !== UPLOAD_ERR_OK) {
                switch ($file_error) {
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        $upload_error = "Ảnh tải lên quá lớn. Vui lòng chọn ảnh nhỏ hơn 2MB.";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $upload_error = "Ảnh tải lên bị gián đoạn.";
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $upload_error = "Chưa chọn ảnh để tải lên.";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $upload_error = "Lỗi hệ thống, thiếu thư mục tạm để tải ảnh.";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $upload_error = "Lỗi ghi ảnh vào ổ đĩa.";
                        break;
                    default:
                        $upload_error = "Lỗi không xác định khi tải ảnh lên.";
                }
            }

            // Kiểm tra định dạng ảnh
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($file_extension, $allowed_extensions)) {
                $upload_error = "Chỉ hỗ trợ các định dạng ảnh: JPG, JPEG, PNG, GIF.";
            }

            // Kiểm tra kích thước ảnh (giới hạn là 2MB)
            if ($file_size > 2 * 1024 * 1024) { // 2MB
                $upload_error = "Ảnh tải lên quá lớn. Vui lòng chọn ảnh nhỏ hơn 2MB.";
            }

            // Nếu không có lỗi, tiến hành lưu ảnh
            if (!$upload_error) {
                $new_file_name = uniqid() . "_" . basename($file_name);
                $upload_dir = 'uploads/'; // Thư mục lưu ảnh

                // Kiểm tra quyền ghi thư mục
                if (!is_writable($upload_dir)) {
                    $upload_error = "Không có quyền ghi vào thư mục lưu ảnh.";
                } else {
                    // Di chuyển ảnh vào thư mục
                    if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                        // Cập nhật ảnh mới vào cơ sở dữ liệu
                        $stmt = $pdo->prepare("UPDATE users SET profile_image = :profile_image WHERE id = :id");
                        $stmt->execute(['profile_image' => $new_file_name, 'id' => $user_id]);
                    } else {
                        $upload_error = "Lỗi khi di chuyển ảnh vào thư mục lưu trữ.";
                    }
                }
            }
        }

        // Cập nhật thông tin vào cơ sở dữ liệu (bao gồm tên, email, điện thoại, địa chỉ)
        $stmt = $pdo->prepare("
            UPDATE users 
            SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone, address = :address 
            WHERE id = :id
        ");
        $stmt->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'id' => $user_id
        ]);

        // Kiểm tra xem có lỗi tải ảnh không
        if ($upload_error) {
            echo "<script>alert('$upload_error'); window.location='index-K.php';</script>";
            exit;
        }

        // Hiển thị thông báo thành công và quay lại trang hồ sơ
        echo "<script>alert('Cập nhật thông tin thành công!'); window.location='profile.php';</script>";
        exit;

    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>

<?php
include 'header.php';

// Kiểm tra đăng nhập
if (!empty($_SESSION['current_user'])) {
    // Khởi tạo biến mặc định
    $error = '';
    $isEditMode = isset($_GET['id']); // Xác định chế độ sửa hay thêm mới
    $user = [
        'email' => '',
        'password' => '',
        'firstname' => '',
        'lastname' => ''
    ];

    // Nếu đang ở chế độ sửa, lấy thông tin user hiện tại
    if ($isEditMode) {
        $stmt = $con->prepare("SELECT * FROM `users` WHERE `id` = ?");
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        // Kiểm tra nếu không tìm thấy user
        if (!$user) {
            $error = "User không tồn tại!";
        }
    }

    // Xử lý khi người dùng submit form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        // Kiểm tra dữ liệu đầu vào
        if (empty($email) || empty($firstname) || empty($lastname)) {
            $error = "Vui lòng nhập đầy đủ thông tin!";
        } else {
            if ($isEditMode) {
                // Cập nhật thông tin user
                if (!empty($password)) {
                    // Nếu người dùng nhập mật khẩu mới
                    $stmt = $con->prepare("UPDATE `users` SET `email` = ?, `password` = ?, `firstname` = ?, `lastname` = ? WHERE `id` = ?");
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash mật khẩu
                    $stmt->bind_param("ssssi", $email, $hashedPassword, $firstname, $lastname, $_GET['id']);
                } else {
                    // Nếu không thay đổi mật khẩu
                    $stmt = $con->prepare("UPDATE `users` SET `email` = ?, `firstname` = ?, `lastname` = ? WHERE `id` = ?");
                    $stmt->bind_param("sssi", $email, $firstname, $lastname, $_GET['id']);
                }
            } else {
                // Thêm user mới
                $stmt = $con->prepare("INSERT INTO `users` (`email`, `password`, `firstname`, `lastname`) VALUES (?, ?, ?, ?)");
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash mật khẩu
                $stmt->bind_param("ssss", $email, $hashedPassword, $firstname, $lastname);
            }

            if ($stmt->execute()) {
                header("Location: user_listing.php"); // Chuyển hướng về danh sách user
                exit;
            } else {
                $error = "Đã có lỗi xảy ra!";
            }
            $stmt->close();
        }
    }
?>
    <div class="main-content">
        <h1><?= $isEditMode ? "Sửa User" : "Thêm User" ?></h1>
        <div class="content-box">
            <form method="POST" action="">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required />

                <label>Mật khẩu:</label>
                <input type="password" name="password" placeholder="<?= $isEditMode ? "Để trống nếu không muốn thay đổi" : "Nhập mật khẩu" ?>" <?= $isEditMode ? "" : "required" ?> />

                <label>Họ:</label>
                <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required />

                <label>Tên:</label>
                <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" required />

                <div class="buttons">
                    <input type="submit" value="<?= $isEditMode ? "Cập nhật" : "Thêm mới" ?>" />
                    <a href="user_listing.php">Quay lại</a>
                </div>
                <div class="clear-both"></div>
                <?php if (!empty($error)) { ?>
                    <div class="error"><?= $error ?></div>
                <?php } ?>
            </form>
        </div>
    </div>
<?php
}
include 'footer.php';
?>

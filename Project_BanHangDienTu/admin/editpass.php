<!DOCTYPE html>
<html>
    <head>
        <title>Đổi thông tin thành viên</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/admin_style.css">
        <style>
            .box-content {
                margin: 0 auto; /* Giữa nội dung */
                width: 800px; /* Chiều rộng của hộp nội dung */
                border: 1px solid #ccc; /* Đường viền hộp */
                text-align: center; /* Canh giữa nội dung trong hộp */
                padding: 20px; /* Khoảng cách bên trong hộp */
            }
            #edit_user form {
                width: 200px; /* Chiều rộng của form */
                margin: 40px auto; /* Giữa form */
            }
            #edit_user form input {
                margin: 5px 0; /* Khoảng cách giữa các trường nhập */
            }
            #btn-submit input {
                font-size: 10px; /* Kích thước chữ của nút */
                padding: 10px; /* Khoảng cách bên trong nút */
            }
        </style>
    </head>
    <body>
        <?php
        include '../connect_db.php'; // Kết nối tới cơ sở dữ liệu
        $error = false; // Biến để lưu lỗi nếu có

        // Kiểm tra nếu có yêu cầu đổi mật khẩu
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            // Kiểm tra các trường nhập đã được cung cấp
            if (isset($_POST['user_id']) && !empty($_POST['user_id']) && 
                isset($_POST['old_password']) && !empty($_POST['old_password']) && 
                isset($_POST['new_password']) && !empty($_POST['new_password'])) {
                
                // Truy vấn để kiểm tra thông tin người dùng
                $userResult = mysqli_query($con, "SELECT * FROM `admin` WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . $_POST['old_password'] . "')");
                
                // Nếu tìm thấy người dùng với mật khẩu cũ đúng
                if ($userResult->num_rows > 0) {
                    // Cập nhật mật khẩu mới cho người dùng
                    $result = mysqli_query($con, "UPDATE `admin` SET `password` = '" . $_POST['new_password'] . "' WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . $_POST['old_password'] . "')");
                    if (!$result) {
                        $error = "Không thể cập nhật tài khoản"; // Lưu lỗi nếu không cập nhật được
                    }
                } else {
                    $error = "Mật khẩu cũ không đúng."; // Lưu lỗi nếu mật khẩu cũ không đúng
                }

                mysqli_close($con); // Đóng kết nối cơ sở dữ liệu

                // Nếu có lỗi, hiển thị thông báo lỗi
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a href="./editpass.php">Đổi lại mật khẩu</a>
                    </div>
                <?php } else { // Nếu không có lỗi ?>
                    <div id="edit-notify" class="box-content">
                        <h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
                        <a href="./index.php">Quay lại tài khoản</a>
                    </div>
                <?php } ?>
            <?php } else { // Nếu thiếu thông tin ?>
                <div id="edit-notify" class="box-content">
                    <h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
                    <a href="./editpass.php"><input type="submit" value="Tiếp tục" /></a>
                </div>
                <?php
            }
        } else { // Nếu không yêu cầu chỉnh sửa mật khẩu
            session_start(); // Bắt đầu phiên làm việc
            $user = $_SESSION['current_user']; // Lấy thông tin người dùng hiện tại

            // Nếu có người dùng đăng nhập
            if (!empty($user)) {
                ?>
                <div id="edit_user" class="box-content">
                    <h2>Xin chào <?= $user['fullname'] ?>, bạn đang thay đổi mật khẩu!</h2>
                    <form action="./editpass.php?action=edit" method="Post" autocomplete="off">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>"> <!-- Lưu ID người dùng  -->
                        <label>Hãy nhập mật khẩu cũ</label></br>
                        <input type="password" name="old_password" value="" /></br>
                        <label>Hãy nhập mật khẩu mới</label></br>
                        <input type="password" name="new_password" value="" /></br>
                        <br><br>
                        <div id="btn-submit"><input type="submit" value="Đổi mật khẩu" /></div>
                    </form>
                </div>
                <?php
            }
        }
        ?>
    </body>
</html>

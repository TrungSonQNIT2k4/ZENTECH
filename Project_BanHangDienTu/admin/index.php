<html>

<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/ZENTECH/Data/Image/ICONLOGOZ.png">
    <link rel="stylesheet" href="/ZENTECH/Project_BanHangDienTu/css/admin_style.css">
</head>

<body>
    <?php
    session_start();

    // Kết nối với cơ sở dữ liệu
    include '../connect_db.php';

    // Khởi tạo biến $error để kiểm tra lỗi
    $error = false;

    // Kiểm tra nếu đã có dữ liệu từ form đăng nhập (username và password)
    if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
        // Truy vấn cơ sở dữ liệu để kiểm tra thông tin đăng nhập
        $result = mysqli_query($con, "SELECT `id`, `username`, `fullname`, `status` FROM `admin` WHERE (`username` ='" . $_POST['username'] . "' AND `password` ='" . $_POST['password'] . "')");

        // Kiểm tra nếu truy vấn bị lỗi
        if (!$result) {
            $error = mysqli_error($con); // Lưu thông báo lỗi vào biến $error
        } else {
            // Lấy thông tin người dùng và lưu vào session
            $user = mysqli_fetch_assoc($result);
            $_SESSION['current_user'] = $user;
        }

        // Đóng kết nối cơ sở dữ liệu
        mysqli_close($con);

        // Nếu có lỗi hoặc không tìm thấy kết quả
        if ($error !== false || $result->num_rows == 0) {
    ?>
            <script>
                // Hiển thị thông báo và chuyển hướng
                alert('Sai tên tài khoản hoặc mật khẩu. Mời bạn đăng nhập lại!');
                window.location.href = './index.php'; // Chuyển hướng về trang đăng nhập
            </script>
        <?php
            exit; // Kết thúc quá trình nếu có lỗi
        } else {
            // Đăng nhập thành công, chuyển hướng thẳng tới product_listing.php
            header("Location: ./product_listing.php");
            exit;
        }
    }
    ?>

    <!-- Hiển thị form đăng nhập -->
    <div class="container-login-admin">
        <div id="user_login" class="box-content">
            <img src="/ZENTECH/Data/Image/LOGO.png" alt="" class="logo-login-admin">
            <h2>Đăng nhập tài khoản Admin </h2>
            <form action="./index.php" method="post" autocomplete="off">
                <p class="title-login">Username</p>
                <input type="text" name="username" value="" placeholder="Nhập tên tài khoản vào đây" class="search-input-login-admin" /><br />
                <p class="title-login">Password</p>
                <input type="password" name="password" value="" placeholder="Nhập mật khẩu vào đây" class="search-input-login-admin" /><br />
                <br>
                <button class="login-button-admin" type="submit">Đăng nhập</button>
            </form>
        </div>
    </div>
</body>

</html>

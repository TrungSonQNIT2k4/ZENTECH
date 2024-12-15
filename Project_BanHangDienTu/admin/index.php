<html>
    <head>
        <title>Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/ZENTECH/Data/Image/ICONLOGOZ.png">
        <link rel="stylesheet" href="/ZENTECH/Project_BanHangDienTu/css/admin_style.css">
        <style>
            .box-content{
                margin: 0 auto; /* Căn giữa nội dung */
                width: 800px;   /* Chiều rộng của khung */
                border: 1px solid #ccc; /* Viền bao quanh */
                text-align: center; /* Căn giữa nội dung bên trong */
                padding: 20px; /* Khoảng cách giữa nội dung và viền */
            }
            
            #user_login form{
                width: 200px; /* Chiều rộng của form */
                margin: 40px auto; /* Căn giữa form với khoảng cách trên và dưới là 40px */
            }
            
            #user_login form input{
                margin: 5px 0; /* Khoảng cách giữa các input */
            }
        </style>
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
                <div id="login-notify" class="box-content">
                    <h1>Thông báo</h1>
                    <h4><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h4>
                    <a href="./index.php">Quay lại</a>
                </div>
                <?php
                exit; // Kết thúc quá trình nếu có lỗi
            }
            ?>
        <?php } ?>

        <!-- Kiểm tra nếu người dùng chưa đăng nhập -->
        <?php if (empty($_SESSION['current_user'])) { ?>
            <!-- Hiển thị form đăng nhập -->
            <div id="user_login" class="box-content">
                <h1>ZENTECH</h1>
                <h2>Đăng nhập tài khoản Admin </h2>
                <form action="./index.php" method="post" autocomplete="off">
                    <label>Username</label><br/>
                    <input type="text" name="username" value="" /><br/>
                    <label>Password</label><br/>
                    <input type="password" name="password" value="" /><br/>
                    <br>
                    <input type="submit" value="Đăng nhập" />
                </form>
            </div>
        <?php } else {
            // Nếu người dùng đã đăng nhập
            $currentUser = $_SESSION['current_user']; // Lấy thông tin người dùng hiện tại từ session
            ?>
            <!-- Hiển thị thông báo đăng nhập thành công và các tùy chọn quản lý -->
            <div id="login-notify" class="box-content">
                <h2>Xin chào <?= $currentUser['fullname'] ?>!<br/></h2>
                <a href="./product_listing.php">Quản lý sản phẩm</a><br/><br/>
                <a href="./editpass.php">Đổi mật khẩu</a><br/><br/>
                <a href="./logout.php">Đăng xuất</a>
            </div>
        <?php } ?>
    </body>
</html>

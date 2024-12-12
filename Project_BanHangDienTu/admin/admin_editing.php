<?php
include 'header.php';
// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!empty($_SESSION['current_user'])) {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    $username = '';
    $password = '';
    $fullname = ''; // New variable for full name

    // Nếu có ID, nghĩa là đang chỉnh sửa admin
    if ($id) {
        $stmt = $con->prepare("SELECT * FROM `admin` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            $username = $admin['username'];
            $password = $admin['password'];
            $fullname = $admin['fullname']; // Fetch the fullname
        }
        $stmt->close();
    }

    // Xử lý khi gửi biểu mẫu
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname']; // Capture the fullname from the form

        if ($id) {
            // Cập nhật admin
            $stmt = $con->prepare("UPDATE `admin` SET `username` = ?, `password` = ?, `fullname` = ? WHERE `id` = ?");
            $stmt->bind_param("sssi", $username, $password, $fullname, $id);
        } else {
            // Thêm admin mới
            $stmt = $con->prepare("INSERT INTO `admin` (`username`, `password`, `fullname`) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $password, $fullname);
        }
        $stmt->execute();
        $stmt->close();

        header("Location: admin_listing.php"); // Chuyển hướng về danh sách admin
        exit;
    }
?>
    <div class="main-content">
        <h1><?= $id ? 'Chỉnh sửa thông tin admin' : 'Thêm admin mới' ?></h1>
        <form method="POST">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>" required><br>
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" value="<?= htmlspecialchars($password) ?>" required><br>
            <label for="fullname">Họ và Tên:</label> <!-- New label for Full Name -->
            <input type="text" name="fullname" id="fullname" value="<?= htmlspecialchars($fullname) ?>" required><br> <!-- New input for Full Name -->
            <input type="submit" value="Lưu">
        </form>
    </div>
<?php
}
include 'footer.php';
?>

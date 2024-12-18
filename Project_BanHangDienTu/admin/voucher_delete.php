<?php
include 'header.php';

if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1>Xóa voucher</h1>
        <div id="content-box">
            <?php
            $error = false;
            // Kiểm tra nếu có ID trong URL
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id = (int)$_GET['id']; 

                if ($id > 0) {
                    include '../connect_db.php';

                    // Sử dụng Prepared Statements để xóa voucher
                    $stmt = $con->prepare("DELETE FROM `voucher` WHERE `id_voucher` = ?");
                    $stmt->bind_param("i", $id);

                    // Thực thi câu lệnh xóa
                    if ($stmt->execute()) {
                        // Thiết lập thông báo thành công trong session
                        $_SESSION['success_message'] = 'Bạn đã xóa voucher thành công!';
                    } else {
                        $error = "Không thể xóa voucher. Vui lòng thử lại sau.";
                    }

                    // Đóng kết nối
                    $stmt->close();
                    mysqli_close($con);
                } else {
                    $error = "ID voucher không hợp lệ.";
                }
            } else {
                $error = "ID voucher không được tìm thấy.";
            }

            // Nếu có lỗi, hiển thị thông báo lỗi
            if ($error !== false) {
                echo '<div id="error-notify" class="box-content">
                        <h2>Thông báo</h2>
                        <h4>' . htmlspecialchars($error) . '</h4>
                        <a href="./voucher_listing.php">Quay lại</a>
                      </div>';
            }

            // Kiểm tra thông báo thành công trong session
            if (isset($_SESSION['success_message'])) {
                // Hiển thị thông báo thành công bằng alert
                echo '<script>
                        alert("' . $_SESSION['success_message'] . '");
                        window.location.href = "voucher_listing.php";
                      </script>';
                // Xóa thông báo sau khi đã hiển thị
                unset($_SESSION['success_message']);
            }
            ?>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>

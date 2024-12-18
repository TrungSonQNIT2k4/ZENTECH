<?php
include 'header.php';

// Kiểm tra đăng nhập
if (!empty($_SESSION['current_user'])) {
    $error = '';
    $isEditMode = isset($_GET['id']);
    $voucher = [
        'id_voucher' => '',
        'mota' => '',
        'giagiam' => '',
        'ngaytao' => date("Y-m-d"),
        'ngayhethan' => '',
        'stt' => ''
    ];

    // Nếu ở chế độ sửa, lấy thông tin voucher hiện tại
    if ($isEditMode) {
        $stmt = $con->prepare("SELECT * FROM `voucher` WHERE `id_voucher` = ?");
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $voucher = $result->fetch_assoc();
        $stmt->close();

        if (!$voucher) {
            $error = "Voucher không tồn tại!";
        }
    }

    // Xử lý khi submit form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_voucher = $_POST['id_voucher'];
        $mota = $_POST['mota'];
        $giagiam = $_POST['giagiam'];
        $ngaytao = $_POST['ngaytao'];
        $ngayhethan = $_POST['ngayhethan'];
        $stt = $_POST['stt'];

        // Kiểm tra dữ liệu đầu vào
        if (empty($id_voucher) || empty($mota) || empty($giagiam) || empty($ngayhethan)) {
            $error = "Vui lòng nhập đầy đủ thông tin!";
        } else {
            if ($isEditMode) {
                // Cập nhật thông tin voucher
                $stmt = $con->prepare("UPDATE `voucher` SET `mota` = ?, `giagiam` = ?, `ngaytao` = ?, `ngayhethan` = ?, `stt` = ? WHERE `id_voucher` = ?");
                $stmt->bind_param("ssssii", $mota, $giagiam, $ngaytao, $ngayhethan, $stt, $id_voucher);
            } else {
                // Kiểm tra xem `id_voucher` có bị trùng không
                $stmt = $con->prepare("SELECT COUNT(*) FROM `voucher` WHERE `id_voucher` = ?");
                $stmt->bind_param("i", $id_voucher);
                $stmt->execute();
                $stmt->bind_result($exists);
                $stmt->fetch();
                $stmt->close();

                if ($exists) {
                    $error = "ID Voucher đã tồn tại!";
                } else {
                    // Thêm mới voucher
                    $stmt = $con->prepare("INSERT INTO `voucher` (`id_voucher`, `mota`, `giagiam`, `ngaytao`, `ngayhethan`, `stt`) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("issssi", $id_voucher, $mota, $giagiam, $ngaytao, $ngayhethan, $stt);
                }
            }

            if (empty($error) && $stmt->execute()) {
                header("Location: voucher_listing.php");
                exit;
            } else {
                $error = $error ?: "Đã có lỗi xảy ra!";
            }
            $stmt->close();
        }
    }
?>
    <div class="main-content">
        <h1><?= $isEditMode ? "Sửa Voucher" : "Thêm Voucher" ?></h1>
        <div class="content-box">
            <form method="POST" action="">
                <label>ID Voucher:</label>
                <input type="number" name="id_voucher" value="<?= htmlspecialchars($voucher['id_voucher']) ?>" <?= $isEditMode ? "readonly" : "required" ?> />

                <label>Mô tả:</label>
                <input type="text" name="mota" value="<?= htmlspecialchars($voucher['mota']) ?>" required />

                <label>Giá giảm:</label>
                <input type="number" name="giagiam" value="<?= htmlspecialchars($voucher['giagiam']) ?>" required />

                <label>Ngày tạo:</label>
                <input type="date" name="ngaytao" value="<?= htmlspecialchars($voucher['ngaytao']) ?>" required />

                <label>Ngày hết hạn:</label>
                <input type="date" name="ngayhethan" value="<?= htmlspecialchars($voucher['ngayhethan']) ?>" required />

                <label>STT:</label>
                <input type="number" name="stt" value="<?= htmlspecialchars($voucher['stt']) ?>" />

                <div class="buttons">
                    <input type="submit" value="<?= $isEditMode ? "Cập nhật" : "Thêm mới" ?>" />
                    <a href="voucher_listing.php">Quay lại</a>
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

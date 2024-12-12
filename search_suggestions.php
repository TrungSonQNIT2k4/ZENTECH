<?php
function connectDatabase() {
    $conn = new mysqli("localhost", "root", "", "zentech");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Kết nối cơ sở dữ liệu
    $conn = connectDatabase();

    // Truy vấn tìm kiếm sản phẩm
    $sql = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($sql);
    $likeSearchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("ss", $likeSearchTerm, $likeSearchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product_relate">
                <div class="info_product_relate">
                    <img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["name"]) . '">
                    <p class="name_product_relate">' . htmlspecialchars($row["name"]) . '</p>
                </div>
                <p class="price_product_relate">' . number_format($row["price"], 0, ',', '.') . ' VNĐ</p>
            </div>';
        }
    } else {
        echo '<p>Không có sản phẩm nào phù hợp.</p>';
    }

    $stmt->close();
    $conn->close();
}
?>

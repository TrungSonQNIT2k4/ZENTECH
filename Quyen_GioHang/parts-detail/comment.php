<?php
include('connect.php');
$user_id = $_SESSION["user_id"] ?? null;
$cart_id = $_SESSION["cart"] ?? null;
$product_id = isset($_GET['id']) ? $_GET['id'] : null;
$error_message = '';

if (isset($_POST['submit']) && $_POST['submit'] === 'send') {

    $noidung = trim($_POST['noidung']);
    if (strlen($noidung) >= 15) {
        $product_id = isset($_GET['id']) ? $_GET['id'] : null;
        $user_id = $_SESSION["user_id"];
        
        if ($product_id === null) {
            die('Sản phẩm không hợp lệ hoặc không tìm thấy.');
        }

        // Sử dụng PDO để chèn dữ liệu vào bảng comment
        $query = "INSERT INTO comment (noidung, created_at, is_reply, product_id, customer_id) 
                  VALUES (:noidung, NOW(), 0, :product_id, :user_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':noidung', $noidung, PDO::PARAM_STR);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "<script>alert('Bình luận của bạn đã được gửi thành công!');</script>";
        } else {
            echo "<script>alert('Lỗi khi gửi bình luận');</script>";
        }
    } else {
        echo "<script>alert('Bạn phải nhập ít nhất 15 kí tự!');</script>";
    }
}

// Lấy thông tin bình luận và phân trang
$product_id = isset($_GET['id']) ? $_GET['id'] : null;
$comments_per_page = 5; // Số bình luận hiển thị mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $comments_per_page;

// Truy vấn lấy danh sách bình luận
$query = "SELECT noidung, content, CONCAT(firstname, ' ', lastname) AS name_cus, 
          admin.fullname AS name_admin, replies.created_at AS reply, 
          comment.created_at AS comment 
          FROM users 
          RIGHT JOIN comment ON comment.customer_id = users.id
          LEFT JOIN replies ON comment.comment_id = replies.comment_id
          LEFT JOIN admin ON replies.admin_id = admin.admin_id 
          WHERE comment.product_id = :product_id
          ORDER BY comment.created_at DESC 
          LIMIT :offset, :comments_per_page";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':comments_per_page', $comments_per_page, PDO::PARAM_INT);
$stmt->execute();

// Truy vấn tổng số bình luận
$query_total = "SELECT COUNT(*) AS total_comments FROM comment WHERE product_id = :product_id";
$stmt_total = $pdo->prepare($query_total);
$stmt_total->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt_total->execute();
$total_comments = $stmt_total->fetch(PDO::FETCH_ASSOC)['total_comments'];
$total_pages = ceil($total_comments / $comments_per_page);
?>

<section>
  <div class="main-container">
      <div class="box-comment">
          <div class="comment">
              <h3 class="title-info">
                  Bình luận về <?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>
              </h3>
              <div class="box-cmt">
                  <form action="" method="POST">
                      <textarea name="noidung" class="comment-des" title="Nội dung" placeholder="Nội dung. Tối thiểu 15 ký tự *"></textarea>         
                      <div class="send-comment">
                          <span class="text">Để gửi bình luận bạn phải nhập nội dung</span>
                          <button class="btn-send" type="submit" name="submit" value="send"><i class="ri-send-plane-2-line"></i> <span class="text-send">gửi bình luận</span></button>
                      </div>
                  </form>
              </div>
          </div>
          
          <!-- cmt của khách hàng -->
          <div class="cmt-custom">
              <?php
              if ($stmt->rowCount() > 0) {
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo '<div class="box-cmt">
                            <div class="flex">
                                <div class="avt">
                                    <img src="assets/image/no-avt.png" alt=""/>
                                </div>
                                <div class="name-and-date">
                                    <strong class="name">' . htmlspecialchars($row['name_cus'], ENT_QUOTES, 'UTF-8') . '</strong>
                                    <div class="date-cmt">' . htmlspecialchars($row['comment'], ENT_QUOTES, 'UTF-8') . '</div>
                                    <div class="cmt">' . htmlspecialchars($row['noidung'], ENT_QUOTES, 'UTF-8') . '</div>
                                </div>
                            </div>';

                      if ($row['reply'] != NULL) {
                          echo '<div class="rep-cmt">
                                  <div class="flex">
                                      <div class="avt"> 
                                          <img src="assets/image/29848-linhdt106-637702321889068869.webp" alt=""/>
                                      </div>
                                      <div class="name-and-date">
                                          <div class="title">
                                              <strong class="name">' . htmlspecialchars($row['name_admin'], ENT_QUOTES, 'UTF-8') . '</strong> 
                                              <span class="department">QTV ZENTECH Mobile</span>
                                          </div>
                                          <div class="date-cmt">' . htmlspecialchars($row['reply'], ENT_QUOTES, 'UTF-8') . '</div>
                                          <div class="cmt">
                                              <p>' . htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8') . '</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>';
                      }
                  }
              } else {
                  echo '<div class="box-no-cmt"> <p class="no-cmt">Chưa có bình luận nào!</p></div>';
              }
              ?>
          </div>

          <!-- Phân trang -->
          <div class="number">
              <?php
              for ($i = 1; $i <= $total_pages; $i++) {
                  echo '<a href="?id=' . $product_id . '&page=' . $i . '" class="so">' . $i . '</a>';
              }
              ?>
          </div>
      </div>
  </div>
</section>

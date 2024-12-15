<?php
 include('connect.php');
$_SESSION["user_id"] ="110" ;
$error_message = '';
 if (isset($_POST['submit']) && $_POST['submit'] === 'send') {
    
//     if (!isset($_SESSION['user_id'])) {
//         header("Location: login.php");
//         exit();
//     }
$noidung=trim($_POST['noidung']) ;
if(strlen($noidung)>= 15){
    $product_id = isset($_GET['id']) ? $_GET['id'] : null;
    $user_id=  $_SESSION["user_id"] ;
    if ($product_id === null) {
        die('Sản phẩm không hợp lệ hoặc không tìm thấy.');
    }
    $query= "INSERT INTO comment (noidung ,created_at, is_reply , product_id , customer_id ) VALUES
     ('$noidung',NOW(),0, '$product_id','$user_id') " ;
    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Bình luận của bạn đã được gửi thành công!');</script>";
    } else {
        echo "<script>alert('Lỗi khi gửi bình luận: " . mysqli_error($connect) . "');</script>";
    }
     
}
    
 else {
    echo "<script>alert('Bạn phải nhập ít nhất 15 kí tự!');</script>";
 }
}
 $product_id = isset($_GET['id']) ? $_GET['id'] : null;
$comments_per_page = 5; // Số bình luận hiển thị mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $comments_per_page;
 $query = "SELECT noidung , content, concat(firstname ,' ', lastname)  as name_cus, admin.name as name_admin ,replies.created_at as reply , comment.created_at as comment from users 
 right join comment on comment.customer_id= users.id
 left join replies on comment.comment_id = replies.comment_id
 left join admin on replies.admin_id = admin.admin_id 
  WHERE comment.product_id = $product_id  ORDER BY comment.created_at DESC
   LIMIT $offset, $comments_per_page";
 $result = mysqli_query($connect, $query);
 $query_total = "SELECT COUNT(*) AS total_comments 
                FROM comment 
                WHERE product_id = $product_id";
$result_total = mysqli_query($connect, $query_total);
$total_comments = mysqli_fetch_assoc($result_total)['total_comments'];
$total_pages = ceil($total_comments / $comments_per_page);

?>

<section> 
  <div class="container">
      <div class="box-comment">
          <div class="comment">
              <h3 class="title-info">
                  Bình luận về Redmi A2+ (3GB/64GB)
                </h3>
                <div class="box-cmt">
                    <form action="" method="POST">
                        
                        <textarea name="noidung" class="comment-des" title="Nội dung" placeholder="Nội dung. Tối thiểu 15 ký tự *"></textarea>         
                    <div class="send-comment">
                        <span class="text">Để gửi bình luận bạn phải nhập nội dung </span>
                        <button class="btn-send" type="submit" name="submit" value="send"><i class="ri-send-plane-2-line"></i> <span class="text-send">gửi bình luận</span>
                   </button>
                            </div></form>
                        </div>
                    </div>
                    
                    <!-- cmt cua khach hang  -->
                    <div class="cmt-custom">
                    <?php
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                       echo'<div class="box-cmt">
                        <div class="flex">
                            <div class="avt">
                                <img src="assets/image/no-avt.png" alt=""/>
                            </div>
                            <div class="name-and-date">
                                <strong class=""name>'.$row['name_cus'].'</strong>
                                <div class="date-cmt">'.$row['comment'].'</div>
                                
                                <div class="cmt">'.$row['noidung'].'</div>
                            </div>
                        </div>';
                        if($row['reply']!=NULL){
                        echo '<div class="rep-cmt">
                            <div class="flex">
                                <div class="avt"> 
                                    <img src="assets/image/29848-linhdt106-637702321889068869.webp" alt=""/>
                                </div>
                                <div class="name-and-date">
                                    <div class="title">
                                        <strong class="name">'.$row['name_admin'].'</strong> 
                                        <span class="department"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11.0026 16L6.75999 11.7574L8.17421 10.3431L11.0026 13.1716L16.6595 7.51472L18.0737 8.92893L11.0026 16Z"></path></svg> QTV ZENTECH Mobile</span>
                                    </div>
                                    <div class="date-cmt">'.$row['reply'].'</div>
                                    <div class="cmt">
                                        <p>'.$row['content'].' </p>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                    </div>
                                    </div>';}
                                     }
                                       }else{
                                        echo '<div class="box-no-cmt"> <p  class="no-cmt">Chưa có bình luận nào!</p></div> ' ;
                                       }
                                          ?>
                                </div>
                                <!-- tới đây -->
                                <div class="number">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<a href="?id='.$product_id.'&page='.$i.'" class="so">'.$i.'</a>';
                }
                ?>
                            </div>
                        </div>
</section>
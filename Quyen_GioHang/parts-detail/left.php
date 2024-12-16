<div class="scroll-box">
            
           <div class="left-info">
            <!-- ảnh sản phẩm -->
            <?php 
            include('show-image.php') ;
            $product_id = isset($_GET['id']) ? $_GET['id'] : null;
            if ($product_id) {
                $query = "SELECT thongso , thuoctinh , mota, product_id , thongso.id_thongso FROM thongso
                right join thuoctinh on thuoctinh.id_thongso = thongso.id_thongso
                inner join motathuoctinh on thuoctinh.id_thuoctinh = motathuoctinh.id_thuoctinh
                 WHERE product_id = $product_id";
                $result = mysqli_query($connect, $query);

                

                $querymain = "SELECT name FROM products
                WHERE products.product_id = $product_id";
               $resultmain = mysqli_query($connect, $querymain);
               $product = mysqli_fetch_assoc($resultmain);
            }


            ?>
      <!-- tới đây -->
        <div class="info-strikings">
            <ul class="info-strikings-list">
                <li><i class="ri-box-1-line"></i> Miễn phí vận chuyển toàn quốc</li>
                <li><i class="ri-shield-check-line"></i> Bảo hành 18 tháng chính hãng.</li>
                <li><i class="ri-box-1-line "></i> Bộ sản phẩm bao gồm: Thân máy, Củ sạc, Cáp USB Type C, Cây lấy SIM, Tài liệu HDSD.</li>
                <li><i class="ri-star-line "></i> 1 đổi 1 trong 30 ngày đầu nếu có lỗi phần cứng do nhà sản xuất.</li>
                <li><i class="ri-bookmark-line"></i> Giá đã bao gồm VAT</li>
            </ul>
        </div> 
        <!-- địa chỉ còn hàng -->
        <?php include('address.php') ;?>
        <div class="info-product">
           <div class="title">
           <i class="ri-list-check"></i>
            thông tin sản phẩm
           </div>
           <div class="info-detail-product">
            <div class="info-description-product">
                
                <h2>Bảng thông số kỹ thuật của <?php echo $product['name'] ?></h2>
               
               <table  >
               <?php 
                if ($result->num_rows > 0) {
                    $current_category = "";
               while ($row = $result->fetch_assoc()) {
                // Nếu danh mục thay đổi, thêm hàng tiêu đề mới
                if ($current_category != $row['thongso']) {
                    $current_category = $row['thongso'];
                   echo ' <tr><th colspan=2>'. $current_category . '</th></tr> ';
                }
                  
                    echo'<tr><td>' . $row['thuoctinh'] .'</td><td>' . $row['mota'] . '</td></tr>';
                        }
                }        
                ?>      
                   
                </table>
               
        
                                                      
                            </div>                            
                        </div>
                    </div>
                    <!-- tới đây -->
                </div>
                <div class="btn">
                <button class="toggle-button" onclick="toggleContent()">Xem thông số kĩ thuật <i class="ri-arrow-down-s-fill"></i></button>
                </div>
            </div>
            

        <!-- thông tin bên phải  -->
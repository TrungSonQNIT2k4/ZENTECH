

<?php
session_start() ;
include('connect.php') ;
$_SESSION["user_id"] ="110" ;
$_SESSION["cart"] ="4" ;
$cart_id= $_SESSION["cart"] ;
$sql = "SELECT cart.user_id, cart.cart_id, cart.product_id, img_url, 
cart.version_id, cart.color_id, products.name, color, version, price, 
price_sale,  cart.quantity , quantity*price as tamtinh FROM  cart
INNER JOIN products ON cart.product_id = products.product_id 
INNER JOIN code_color ON cart.color_id = code_color.color_id 
INNER JOIN color_image ON code_color.color_id = color_image.color_id
INNER JOIN version ON color_image.product_id = version.product_id  
WHERE cart.cart_id = '$cart_id' AND cart.version_id = version.version_id 
GROUP BY cart.user_id, cart.cart_id, products.product_id,  cart.version_id, cart.color_id, 
products.name,  version.version_id;";
$result = mysqli_query($connect, $sql) ;
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $product_id = $_GET['product_id'];
    $color_id = $_GET['color_id'];
    $version_id = $_GET['version_id'];
    $user_id = $_SESSION['user_id'];
    $query = "DELETE FROM cart 
              WHERE cart_id = '$cart_id' 
              AND product_id = '$product_id' 
              AND color_id = '$color_id' 
              AND version_id = '$version_id'
              AND user_id = '$user_id'";
        
    if (mysqli_query($connect, $query)) {
        echo "<script>alert('xóa sản phẩm thành công!');</script>";
        header("Location: cart.php");
        exit();
    } else {
        echo "Lỗi khi xóa sản phẩm: " . mysqli_error($connect);
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'increase') {
    $product_id = $_GET['product_id'];
    $color_id = $_GET['color_id'];
    $version_id = $_GET['version_id'];
    $user_id = $_SESSION['user_id'];
    $query = "UPDATE cart SET quantity = quantity -1 
              WHERE cart_id = '$cart_id' 
              AND product_id = '$product_id' 
              AND color_id = '$color_id' 
              AND version_id = '$version_id'
              AND user_id = '$user_id'";
        
    if (mysqli_query($connect, $query)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Lỗi khi xóa sản phẩm: " . mysqli_error($connect);
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'crease') {
    $product_id = $_GET['product_id'];
    $color_id = $_GET['color_id'];
    $version_id = $_GET['version_id'];
    $user_id = $_SESSION['user_id'];
    $query = "UPDATE cart SET quantity = quantity +1 
              WHERE cart_id = '$cart_id' 
              AND product_id = '$product_id' 
              AND color_id = '$color_id' 
              AND version_id = '$version_id'
              AND user_id = '$user_id'";
        
    if (mysqli_query($connect, $query)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Lỗi khi xóa sản phẩm: " . mysqli_error($connect);
    }
}
function format_currency($number) {
    return number_format($number, 0, ',', '.') . ' đ';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="assets/css/style-cart.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<section>
    <div class="container">
        <div class="cart-product">
            <!-- thông tin bên trái -->
             <div class="left">
             <div class="head">
           <div class="icon"><i class="ri-arrow-left-s-line"></i></div>
           <span class="text"> Quay lại</span>
        </div>
        
        <div class="box-table">
        <table>
       
            <tr><th>sản phẩm</th><th>thuộc tính</th> <th>giá</th><th>số lượng</th>
             <th>tạm tính</th>
        </tr>
          <?php  if (mysqli_num_rows($result) > 0) {
            $tong= 0 ;
            while ($row = mysqli_fetch_assoc($result)) {
                $tong = $tong + $row['tamtinh'] ;
       echo ' <tr><td><div class="flex">
          <a href="cart.php?action=delete&product_id='.$row['product_id'].'&cart_id='.$row['cart_id'].'&user_id='.$row['user_id'].'&color_id='.$row['color_id'].'&version_id='.$row['version_id'].'">
                <div class="delete-product">xóa</div>
            </a>
             <a href="index-detail.php?id='.$row['product_id'].'"><div class="image-product"><img src="assets/image/'.$row['img_url'].'" alt=""/></div></a>
            
             <div class="name">
             '.$row['name'].'
             </div>
             </div>
             </td>   
             <td>  <div class="color">'.$row['color'].'
            </div>
                   <div class="version" > '.$row['version'].'</div>
             </td>
             <td><div class="price">
                   '.number_format($row['price']).'đ
                </div></td>
                <td>
                <div class="soluong">
                   <div class="flex">
                   
                   <div class="count">
                   <a href="cart.php?action=increase&product_id='.$row['product_id'].'&cart_id='.$row['cart_id'].'&user_id='.$row['user_id'].'&color_id='.$row['color_id'].'&version_id='.$row['version_id'].'"> 
                   <div class="dau">-</div></a>
                    <div class="dau">'.$row['quantity'].'</div>
                    <a href="cart.php?action=crease&product_id='.$row['product_id'].'&cart_id='.$row['cart_id'].'&user_id='.$row['user_id'].'&color_id='.$row['color_id'].'&version_id='.$row['version_id'].'">
                     <div class="dau">+</div></a>
                   </div>
                   </div>
                   
                </div>
                </td>
                <td><div class="price">
                '.number_format($row['tamtinh']).'đ
                </div></td>
        </tr> ';
    }
    }
        ?>
        </table> 
             </div>
        </div>
        
        <!-- thông tin bên phải -->
        <div class="right">
           <p class="title">cộng giỏ hàng</p>
          <div class="flex"> <p>Tạm tính</p> <span><?php echo number_format($tong)?>đ</span> </div>
           <div class="flex"> <p>Tổng</p> <span><?php echo number_format($tong)?>đ</span></div>
            <button class="thanhtoan">tiến hành thanh toán </button>
        </div>
    
     </div>
     </div>
</section>
</body>
</html>
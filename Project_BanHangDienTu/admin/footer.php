<link rel="stylesheet" href="css/admin_style.css">
<?php if (!empty($_SESSION['current_user'])) { ?> <!-- Kiểm tra xem người dùng đã đăng nhập hay chưa -->
    <div class="clear-both"></div> 
    </div>
    </div>
    <div id="admin-footer"> 
        <div class="container"> 
            <div class="left-panel"> 
                © Copyright 2024 - ZENTECH 
            </div>
            <div class="right-panel"> 
                <a href="#" title="Facebook" target="_blank"> 
                    <img height="48" src="../icon/facebook.png" alt="Facebook" /> 
                </a>
                <a href="#" title="YouTube" target="_blank"> 
                    <img height="48" src="../icon/youtube.png" alt="YouTube" /> 
                </a>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
<?php } else { ?> <!-- Nếu người dùng chưa đăng nhập -->
    <div class="container"> 
        <div class="box-content"> 
            Bạn chưa đăng nhập. Mời bạn quay lại đăng nhập quản trị <a href="index.php">tại đây</a> 
        </div>
    </div>
<?php } ?> 
<style>
#admin-footer { 
    background-color: #f4f4f4; 
    padding: 10px 0; 
    border-top: 1px solid #ccc; 
    margin-top: 20px; 
}

.left-panel, .right-panel { 
    display: inline-block; 
    vertical-align: middle; 
}

.left-panel {
    float: left; 
    font-size: 14px; 
    color: #333; 
}

.right-panel { 
    float: right; 
}

.right-panel a { 
    margin-left: 10px; 
    text-decoration: none; 
}

.clear-both { 
    clear: both; 
}
</style>
</body>
</html>

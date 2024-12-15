<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "zentech";
$con = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()){// Kiểm tra nếu kết nối thất bại
    echo "Connection Fail: ".mysqli_connect_errno();exit;
}
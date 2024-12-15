<?php
$host='localhost';
$namehost='root';
$passhost='';
$csdl='zentech';

$connect=new mysqLi($host,$namehost,$passhost,$csdl) or die ("Không thể kết nối Database");
mysqli_query($connect,"SET NAMES 'UTF8'");

?>




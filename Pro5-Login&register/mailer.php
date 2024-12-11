<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = 'smtp.gmail.com'; // Máy chủ SMTP
$mail->SMTPAuth = true;
$mail->Username = 'emrisgrindelwald@gmail.com'; // Email của bạn
$mail->Password = 'amkdgydmvfnsqxal'; // Mật khẩu hoặc mật khẩu ứng dụng
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Hoặc ENCRYPTION_SMTPS nếu dùng SSL
$mail->Port = 587; // 587 (TLS) hoặc 465 (SSL)


$mail->isHtml(true);

return $mail;

?>


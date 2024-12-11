<?php
session_start(); // Đảm bảo session đã được khởi tạo

if (isset($_GET['message']) && $_GET['message'] == 'Password reset successful') {
    echo "<script>alert('Mật khẩu đã được thay đổi thành công!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../Pro5-Login&register/css/login.css">
</head>
<main>
    <section class="container-login">
        <input type="checkbox" id="register_toggle">
        <div class="slider">
            <!-- Form đăng nhập -->
            <form  class="form" id="login-form" method="post" action="includes/functions.php?action=login">
                <span class="title-l">Đăng nhập</span>
                <p>Đăng nhập để trải nghiệm dịch vụ tại Zentech</p>
                <div class="form_control">    
                    <input class="input" type="email" name="email" required>
                    <label class="label"><svg height="18" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg">
                            <g id="Layer_3" data-name="Layer 3">
                                <path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
                            </g>
                        </svg>Nhập Email của bạn</label>
                </div>
                <div class="form_control">
                    <input class="input" type="password" name="password" required>
                    <label class="label">
                            <svg height="16" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                                <path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path><path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
                            </svg>Nhập mật khẩu của bạn</label>
                </div>
                <div class="flex-row">
                    <div>
                        <input type="checkbox" name="remember_me"> Ghi nhớ tôi
                    </div>
                    <span class="span" ><a href="forgot-password.php">Quên mật khẩu?</a></span>
                    
                    <span class="bottom_text">Bạn chưa có tài khoản? <label for="register_toggle" class="swtich">Đăng kí</label> </span>
                </div>

                <button type="submit">Đăng nhập</button>
                
            </form>

            <!-- Form đăng ký -->
            <form class="form" id="register-form" method="post" action="includes/functions.php?action=register">
                <span class="title">Đăng ký tài khoản</span>

                <div class="flex-row">
                    <div class="form_control">
                        <input type="text" class="input" name="firstname" required>
                        <label class="label">
                            <svg height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/>
                            </svg>Họ
                        </label>
                    </div>
                    <div class="form_control">
                        <input type="text" class="input" name="lastname" required>
                        <label class="label">
                            <svg height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/>
                            </svg>Tên
                        </label>
                    </div>
                </div>
                <div class="flex-row">
                    <div class="form_control">
                    <input type="email" class="input" name="email" required>
                        <label class="label">
                            <svg height="18" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg">
                                <g id="Layer_3" data-name="Layer 3">
                                    <path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
                                </g>
                            </svg>Nhập email.</label>
                    </div>
                    <div class="form_control">
                        <input type="text" class="input" name="phone" required>
                        <label class="label">
                            <svg height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                            </svg>Nhập sđt.
                        </label>
                    </div>
                </div>
                <div class="flex-row">
                    <div class="form_control">
                        <input type="text" class="input" name="address" required>
                        <label class="label">
                            <svg height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                            </svg>Nhập địa chỉ của bạn.</label>
                    </div>
                    <div class="form_control">
                        <input type="password" class="input" name="password" required>
                        <label class="label">
                            <svg height="16" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                                <path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path><path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
                            </svg>Nhập mật khẩu</label>
                    </div>
                </div>    
                <small class="error_message">Mật khẩu phải gồm ít nhất 1 chữ cái, 1 chữ số, và 7 ký tự.</small>
                
                <button type="submit">Đăng ký</button>

                <span class="bottom_text">Bạn đã có tài khoản? <label for="register_toggle" class="swtich">Đăng nhập</label> </span>
            </form>
        </div>
    </section>

    <script src="../Pro5-Login&register/js/script.js"></script>
    </main>
</html>

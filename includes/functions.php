<?php
session_start();
require 'db.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'login') {
        login();
    } elseif ($action == 'register') {
        register();
    }
}

function login() {
    global $pdo;
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Tìm kiếm người dùng trong CSDL
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "<script>
            alert('Tài khoản không tồn tại. Vui lòng kiểm tra lại email hoặc đăng ký tài khoản mới.');
            window.location='../login.php';
        </script>";
        exit; // Ngăn mã tiếp tục chạy
    }

    // Kiểm tra mật khẩu và thông báo nếu sai
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Đồng nhất key
        header("Location: /ZENTECH/indexA.php");
        exit; // Ngăn mã tiếp tục chạy
    } else {
        echo "<script>alert('Sai mật khẩu hoặc email.'); window.location='../login.php';</script>";
    }
}

function register() {
    global $pdo;

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra email trùng lặp
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Email đã tồn tại!'); window.location='../login.php';</script>";
        exit;
    }

    // Kiểm tra độ mạnh của mật khẩu
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{7,}$/", $password)) {
        echo "<script>alert('Mật khẩu phải có ít nhất 1 chữ cái, 1 số và 7 ký tự.'); window.location='../login.php';</script>";
        exit;
    }

    // Lưu người dùng vào CSDL
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, address, phone, email, password) VALUES (:firstname, :lastname, :address, :phone, :email, :password)");
    $stmt->execute([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'address' => $address,
        'phone' => $phone,
        'email' => $email,
        'password' => $hashedPassword
    ]);

    header("Location: ../login.php");
}
?>

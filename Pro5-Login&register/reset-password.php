<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

require_once 'db.php';

$stmt = $pdo->prepare("SELECT * FROM users 
                        WHERE reset_token_hash = :token_hash");

$stmt->bindValue(':token_hash', $token_hash, PDO::PARAM_STR);

$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user == false){
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()){
    die("token has expired");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Pro5-Login&register/assets/forgotpassform.css">
    <title>Reset Password</title>
</head>
<body>

    <section class="main-content">

    <!-- Form nhập mật khẩu mới -->
        <form method="post" action="process-reset-password.php" class="form">
            <h1>Reset Password</h1>
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <div class="input-container">
                <label for="new_password">New password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="input-container">
                <label for="confirm_password">Repeat password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="button-container">
                <button type="submit">Submit</button>
            </div>
        </form>
    </section>
    <!-- Hiển thị thông báo lỗi nếu có -->
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>Error: " . htmlspecialchars($_GET['error']) . "</p>";
    }
    ?>
</body>
</html>
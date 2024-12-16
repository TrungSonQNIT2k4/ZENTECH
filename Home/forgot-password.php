<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ZENTECH/assets-K/forgotpassform.css">
    <title>Quên mật khẩu</title>
</head>
<body>

    <section class="main-content">

        <form method="post" action="send-password-reset.php" class="form">
            <h1 class="title">Quên Mật Khẩu</h1>
            <div class="input-container"> 
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="button-container">
                <button type="submit">Gửi</button>
            </div>
        </form>
    </section>
</body>
</html>

<?php

use SendGrid\Mail\Subject;

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

require_once 'db.php';

$stmt = $pdo->prepare("UPDATE users 
                       SET reset_token_hash = :token_hash, 
                           reset_token_expires_at = :expiry
                       WHERE email = :email");

$stmt->execute([
    'token_hash' => $token_hash,
    'expiry' => $expiry,
    'email' => $email
]);

if ($stmt->rowCount() > 0) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost/Pro5-Login&register/reset-password.php?token=$token">here</a>
    to reset your password.

    END;

    try{
        $mail->send();
    } catch (Exception $e){

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }


}

echo "Message sent, please check inbox.";
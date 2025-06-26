<?php
session_start();
require_once 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];

    if ($newPassword !== $confirmNewPassword) {
        $message = "Passwords do not match!";
    } else {
        $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
        if ($check->num_rows === 1) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET password = '$hashedPassword' WHERE email = '$email'");
            $message = "Password successfully updated!";
        } else {
            $message = "Email not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="form-box active">
        <h2 style="margin-top: 0;">Reset Password</h2>
        <?php if (!empty($message)) echo "<p class='error-message'>$message</p>"; ?>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Enter your registered email" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_new_password" placeholder="Confirm New Password" required>
            <button type="submit">G na?</button>
            <p><a href="index.php">Back to Login</a></p>
        </form>
    </div>
</div>
</body>
</html>

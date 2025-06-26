<?php

session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>HashBrown</title>
    </head>
    <body>
        <div class="container">
            <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
                <img src="hashbrown logo.png">
                <h2 class="title" style="font-size: 40px;">HashBrown</h2>
                <p style="color: #e0771b;">(pero orange)</p>
                <form action="login_register.php" method="post">
                    <h2>Login</h2>
                    <?= showError($errors['login']); ?>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required style="margin-bottom: 5px;">
                    <p style="text-align: right; margin-right: 10px; font-size: 13px;"><a href="forgot_password.php">Limtan mo password mo noh?</a></p>
                    <button type="submit" name="login">Login</button>
                    <p>Don't have an account? <a href="#" onclick="showForm('register-form')">Register</a> ka anay e. kupal!</p>
                </form>
            </div>

            <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
                <img src="hashbrown logo.png">
                <h2 class="title" style="font-size: 40px;">HashBrown</h2>
                <p style="color: #e0771b;">(pero orange)</p>
                <form action="login_register.php" method="post">
                    <h2>Register</h2>
                    <?= showError($errors['register']); ?>
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm-pass" placeholder="Confirm Password" required>
                    <button type="submit" name="register">Register</button>
                    <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a> ka na e malamang.</p>
                </form>
            </div>
        </div>

        <script src="script.js"></script>
    </body>
</html>
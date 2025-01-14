<?php 
session_start();
include_once('api/db.php');

if(array_key_exists('token', $_SESSION)){
    $token = $_SESSION['token'];
    $userId = $db->query("SELECT id FROM users WHERE api_token = '$token'")->fetchAll();
    
    if(!empty($userId)){
        header('Location: user.php');
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в систему | ЦРБ Карасук Онлайн</title>
    <link rel="stylesheet" href="styles/pages/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Вход в личный кабинет</h1>
            <p>Введите ваши учетные данные</p>
        </div>

        <form method="POST" action="api/auth.php" class="login-form">
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="email" name="email" id="email" required>
                <?php 
                if(isset($_SESSION['login-error'])) {
                    echo "<span class='error'>" . $_SESSION['login-error'] . "</span>";
                    unset($_SESSION['login-error']);
                }
                ?>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Запомнить меня</label>
            </div>

            <button type="submit" class="btn">Войти</button>

            <div class="links">
                <a href="forgot-password.php">Забыли пароль?</a>
                <a href="register.php">Регистрация</a>
                <a href="index.php">На главную</a>
            </div>
        </form>
    </div>
</body>
</html>
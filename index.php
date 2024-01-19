<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: public/pages/index.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизація та реєстрація</title>
    <?php  require_once 'public/blocks/head.php'; ?>
    <link rel="stylesheet" href="assets/CSS/index.css">
</head>
<body>

<!-- Форма авторизации -->

<div class="page" style="width:50%;">
    <form action="vendor/signin.php" method="post">
        <label>Логін</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <button class="btn" type="submit">Увійти</button>
        <p>
            Немаєте акаунту? - <a href="/register.php">зареєструйтесь</a>!
        </p>
        <?php
            if (isset($_SESSION['message'])) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>
        </div>
            <script src="assets/js/color.js"></script>
</body>
</html>
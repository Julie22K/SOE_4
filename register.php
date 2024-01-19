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

    <!-- Форма регистрации -->
    <div class="page" style="width:50%;">
    <form action="vendor/signup.php" method="post" enctype="multipart/form-data">
        <label>Ім'я</label>
        <input type="text" name="full_name" placeholder="Введите свое полное имя">
        <label>Логін</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Ел.пошта</label>
        <input type="email" name="email" placeholder="Введите адрес своей почты">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <label>Пітвердження пароля</label>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <button class="btn" type="submit">Увійти</button>
        <p>
            Ви вже маєте акаунт? - <a href="/">атворизуйтесь</a>!
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
<?php
$start_page=false;
$redirect_path = 'public/pages/index.php';
require_once 'public/blocks/auth/head.php';
?>

<!-- Форма регистрации -->
<div class="page" style="width:50%;">
    <form action="/vendor/auth/signup.php" method="POST" enctype="multipart/form-data">
        <label>Ім'я</label>
        <input type="text" name="login" placeholder="Введіть своє ім'я">
        <label>Ел.пошта</label>
        <input type="email" name="email" placeholder="Введіть електронну пошту">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введіть пароль">
        <label>Пітвердження пароля</label>
        <input type="password" name="password_confirm" placeholder="Підтвердьте пароль">
        <button class="btn" type="submit">Увійти</button>
        <p>
            Ви вже маєте акаунт? - <a href="/">авторизуйтесь</a>!
        </p>
        <?php require_once 'public/blocks/auth/message.php'; ?>
    </form>
</div>


<?php require_once 'public/blocks/auth/footer.php'; ?>
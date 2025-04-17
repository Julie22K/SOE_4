<?php
$start_page=true;
$redirect_path = 'public/pages/index.php';
require_once 'public/blocks/auth/head.php';
?>

<!-- Форма авторизации -->

<div class="page" style="width:50%;">
    <form action="vendor/auth/signin.php" method="POST">
        <label>Логін</label>
        <input type="text" name="login" placeholder="Введіть свій логін">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введіть пароль">
        <button class="btn" type="submit">Увійти</button>
        <p>
            Немаєте акаунту? - <a href="/register.php">Зареєструйтесь</a>!
        </p>
        <?php require_once 'public/blocks/auth/message.php'; ?>
    </form>
</div>



<?php require_once 'public/blocks/auth/footer.php'; ?>
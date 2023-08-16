<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизація та реєстрація</title>
    <link rel="stylesheet" href="assets/CSS/index.css">
</head>
<body>

    <!-- Профиль -->

    <form>
        <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
        <a href="#"><?= $_SESSION['user']['email'] ?></a>
        <a href="vendor/logout.php" class="logout">Вихід</a>
    </form>

</body>
</html>
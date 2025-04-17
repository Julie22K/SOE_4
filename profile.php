<?php
$start_page=false;
$redirect_path = '/';
require_once 'public/blocks/auth/head.php';
?>

<!-- Профиль -->
<form>
    <h2 style="margin: 10px 0;"><?= $_SESSION['user']['login'] ?></h2>
    <a href="#"><?= $_SESSION['user']['email'] ?></a>
    <a href="vendor/auth/logout.php" class="logout">Вихід</a>
</form>

<?php require_once 'public/blocks/auth/footer.php'; ?>
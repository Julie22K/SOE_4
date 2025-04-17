<?php
session_start();

// echo $redirect_path;
if ($start_page) {
    // signin
    if (isset($_SESSION['user'])) {
        header('Location: ' . $redirect_path);
    }
} else {
    // register/profile
    if (isset($_SESSION['user'])) {
        header('Location: ' . $redirect_path);
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизація та реєстрація</title>
    <?php require_once 'C:\Users\Laptopchik\source\soe4\SOE_4\public\blocks\head_links.php'; ?>
    <link rel="stylesheet" href="assets/CSS/index.css">
</head>

<body>
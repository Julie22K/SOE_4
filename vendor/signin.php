<?php

    session_start();
    $par1_ip = "127.0.0.1";
    $par2_name = 'root';
    $par3_p = '';
    $par4_dp = 'soe';
    $connect= mysqli_connect($par1_ip, $par2_name, $par3_p, $par4_dp);
    
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "full_name" => $user['full_name'],
            "email" => $user['email']
        ];

        header('Location: ../public/pages/index.php');

    } else {
        $_SESSION['message'] = 'Не вірний логін або пароль';
        header('Location: ../index.php');
    }
    ?>


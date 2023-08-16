<?php

    session_start();
    
    $par1_ip = "127.0.0.1";
    $par2_name = 'root';
    $par3_p = '';
    $par4_dp = 'soe';
    $connect= mysqli_connect($par1_ip, $par2_name, $par3_p, $par4_dp);

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `users` ( `full_name`, `login`, `email`, `password`) VALUES ('$full_name', '$login', '$email', '$password')");

        $_SESSION['message'] = 'Реєстрація пройшла успішно!';
        header('Location: ../index.php');


    } else {
        $_SESSION['message'] = 'Паролі не співпадають';
        header('Location: ../register.php');
    }

?>

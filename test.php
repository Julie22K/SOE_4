<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-family: 'Ubuntu', sans-serif;
        }
    </style>
</head>
<body>
<?php
require 'config/connect.php';
$fulldata = mysqli_query($soe, "SELECT * FROM menu_fulldata;");

$fulldata = mysqli_fetch_assoc($fulldata);

$vitmin = mysqli_query($soe, "SELECT * FROM menu_vits_and_mins;");
$vitmin = mysqli_fetch_assoc($vitmin);?>
</body>
</html>

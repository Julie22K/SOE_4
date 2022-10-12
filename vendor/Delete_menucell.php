<?php

require_once '../config/connect.php';

$post_id = $_GET['id'];
$post_day = $_GET['day'];
$post_time = $_GET['time'];

mysqli_query($soe, "DELETE FROM `shoplist` WHERE `DishID` = '$post_id'");
mysqli_query($soe, "DELETE FROM `dishes` WHERE `day`='$post_day' and `time`='$post_time'");


header('Location: ../menu.php');
?>
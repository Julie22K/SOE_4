<?php

require_once '../config/connect.php';

$post_id = $_GET['id'];

mysqli_query($soe, "DELETE FROM `dishes` WHERE `RecipeID` = '$post_id'"); //for dishes!!!

mysqli_query($soe, "DELETE FROM `ingridients` WHERE `RecipeID` = '$post_id'");

mysqli_query($soe, "DELETE FROM `recipes` WHERE `ID` = '$post_id'");

header('Location: ../recipes.php');
?>
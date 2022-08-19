<?php
require_once '../config/connect.php';

$id = $_POST['idc'];
$recipes = mysqli_query($soe, "SELECT * FROM `recipes` WHERE `ID`='$id'");
$recipe = mysqli_fetch_assoc($recipes);

$d_name = $recipe['Name'];
$d_type = $recipe['Type'];
$d_weight = $recipe['Weight'];
$d_price = $recipe['Price'];


header('Location: ../menu.php');

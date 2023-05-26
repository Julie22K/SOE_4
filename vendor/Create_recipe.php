<?php
require_once '../config/connect.php';
require_once '../config/nutr.php';

$Name = $_POST['name'];
$Type = $_POST['type'];
$Image = $_POST['image'];
$Description = $_POST['description'];
$Video = $_POST['videoURL'];

$count = $_POST['number_ingredients'];


mysqli_query($soe, "INSERT INTO `recipes`(`Name`, `Type`, `Image`, `Description`, `Video`) VALUES ('$Name','$Type','$Image','$Description','$Video')");

$recipe = mysqli_fetch_assoc(mysqli_query($soe, "SELECT * FROM `recipes` WHERE `Name` = '$Name' AND `Description` = '$Description'"));

$recipe_id = $recipe['ID'];

for ($i = 0; $i < $count; $i += 1) {

  $product_id = $_POST["new_i_" . $i . "_id"];
  $weight = $_POST["new_i_" . $i . "_weight"];

  mysqli_query($soe, "INSERT INTO `ingridients`(`Weight`, `ProductID`, `RecipeID`) VALUES ('$weight','$product_id','$recipe_id')");
}

header('Location: ../recipes.php');
<?php
require_once '../config/connect.php';
require_once '../config/nutr.php';

$Name = $_POST['name'];
$Type = $_POST['type'];
$Image = $_POST['image'];
$Description = $_POST['description'];
$Video = $_POST['videoURL'];

$count = $_POST['numofingrs'];


mysqli_query($soe, "INSERT INTO `recipes`(`Name`, `Type`, `Image`, `Video`, `Description`) 
VALUES ('$Name','$Type','$Image','$Description','$Video')");

$recipes = mysqli_query($soe, "SELECT * FROM `recipes` WHERE `Name` = '$Name' AND `Description` = '$Description'");
$recipe = mysqli_fetch_assoc($recipes);

$RecipeID = $recipe['ID'];

for ($i = 0; $i < $count; $i += 1) {

  $ProductID = $_POST["product$i"];
  $weight = $_POST["weight$i"];

  mysqli_query($soe, "INSERT INTO `ingridients`(`Weight`, `ProductID`, `RecipeID`) 
  VALUES ('$weight','$ProductID','$RecipeID')");
}


header('Location: ../recipes.php');

<?php
require 'C:\Users\Julie\source\SOE_4\config/connect.php';
$ID_recipe = $_POST['id_recipe'];
$Name = $_POST['name'];
$Type = $_POST['type'];
$Image = $_POST['image'];
$Description = $_POST['description'];
$Video = $_POST['videoURL'];

$count = $_POST['numofingrs'];


mysqli_query($soe, "UPDATE `recipes` SET `Name`='$Name',`Type`='$Type',`Image`='$Image',`Video`='$Video',`Description`='$Description' WHERE `ID`='$ID_recipe'");



//delete_all_old_ingridients
mysqli_query($soe, "DELETE FROM `ingridients` WHERE `RecipeID`='$ID_recipe'");


for ($i = 0; $i < $count; $i += 1) {

    $ProductID = $_POST["product$i"];
    $weight = $_POST["weight$i"];

    mysqli_query($soe, "INSERT INTO `ingridients`(`Weight`, `ProductID`, `RecipeID`) 
VALUES ('$weight','$ProductID','$ID_recipe')");
}
header('Location: ../../recipes.php');

<?php
require_once '../config/connect.php';

try{
$Recipe_ID = $_POST['recipe_id_chooseDaT'];

$ingrs_ = mysqli_query($soe, "SELECT * FROM `ingridients` WHERE `RecipeID`='$Recipe_ID'");
$ingrs_ = mysqli_fetch_all($ingrs_);

foreach ($days as $day) {
    $arr = $_POST["$day"];
    if (!empty($arr)) {
        foreach ($arr as $time) {

            mysqli_query($soe, "INSERT INTO `dishes`(`Day`, `Time`, `RecipeID`) VALUES ('$day','$time','$Recipe_ID')");

            $dishes = mysqli_query($soe, "SELECT * FROM `dishes` WHERE `Time`='$time' AND `Day`='$day'AND `RecipeID`='$Recipe_ID'");
            $dish = mysqli_fetch_assoc($dishes);
            $dish_id = $dish['ID'];
            foreach ($ingrs as $ingr) {
                mysqli_query($soe, "INSERT INTO `shoplist`(`Done`, `IngridientID`, `DishID`) VALUES ('0','$ingr[0]','$dish_id')");
            }
        }
    }
}
header('Location: ../menu.php');
} catch (Exception $e) {
    $e->getMessage();
}


<?php
require_once '../config/connect.php';

$Recipe_ID = $_POST['recipe_id'];

$ingrs = mysqli_query($soe, "SELECT * FROM `ingridients` WHERE `RecipeID`='$Recipe_ID'");
$ingrs = mysqli_fetch_all($ingrs);

$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
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

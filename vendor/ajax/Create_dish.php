<?php
require 'C:\Users\Dell\source\SOE_4\config/connect.php';

try {
    $recipe_id = $_POST['recipe_id'];
    $day = $_POST['day'];
    $time = $_POST['time'];

    $ingredients_ = mysqli_query($soe, "SELECT * FROM `ingridients` WHERE `RecipeID`='$recipe_id'");
    $ingredients_ = mysqli_fetch_all($ingredients_);

    mysqli_query($soe, "INSERT INTO `dishes`(`Day`, `Time`, `RecipeID`) VALUES ('$day','$time','$recipe_id')");

    $dishes = mysqli_query($soe, "SELECT * FROM `dishes` WHERE `Time`='$time' AND `Day`='$day'AND `RecipeID`='$recipe_id'");
    $dish = mysqli_fetch_assoc($dishes);

    $dish_id = $dish['ID'];

    foreach ($ingredients_ as $ingr_) {
        mysqli_query($soe, "INSERT INTO `shoplist`(`Done`, `IngridientID`, `DishID`) VALUES ('0','$ingr_[0]','$dish_id')");
    }
} catch (Exception $e) {
    echo $e;
}

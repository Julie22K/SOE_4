<?php

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\MealTime;
use App\Models\Product;
use App\Models\Recipe;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Додати страву</title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page">
                <h1>Додавання страви до меню:</h1>
                <form action="../../vendor/dish/store.php" method="post">

                    <div class="col">
                        <div class="m-3 w-full">
                            <label for="recipes">Рецепти:</label>
                            <select class="select2-add" name="recipes[]" id="recipes" multiple>
                            <option selected="selected" disabled>Оберіть страви</option>
                                <?php
                                $recipes = Recipe::all();
                                foreach ($recipes as $recipe) {
                                ?>
                                    <option value="<?= $recipe->id ?>"><?= $recipe->title ?></option>
                                <?php
                                }

                                $date = $_GET['date'];
                                $time = $_GET['time'];
                                $menu = $_GET['menu'];

                                ?>
                            </select>
                        </div><input type="text" style="visibility: hidden;" value="<?= $menu ?>" name="menu">
                        <div class="row j-c-be">
                            <div class="m-3 w-half">
                                <label for="date">Дата:</label>
                                <input type="date" name="date" id="date" value="<?= $date ?>">
                            </div>
                            <div class="m-3 w-half">
                                <label for="meal_time_id">Час:</label>
                                <select name="meal_time_id" id="meal_time_id">
                                    <?php
                                    $meal_times = MealTime::all();
                                    foreach ($meal_times as $meal_time) {
                                    ?>
                                        <option value="<?= $meal_time->id ?>" <?= $meal_time->id == $time ? 'selected' : '' ?>><?= $meal_time->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                        <?php
                            if ($_SESSION['errors']) {
                                foreach($_SESSION['errors'] as $error)
                                    echo '<p class="error"> ' . $error . ' </p>';
                            }
                            unset($_SESSION['errors']);
                        ?>
                    <div class="row j-c-be">
                        <button type="submit" class="btn btn-save">Додати</button>
                        <button type="button" class="btn btn-cancel" onclick="location.href='../pages/menu.php?id=<?= $menu ?>'">Повернутись</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
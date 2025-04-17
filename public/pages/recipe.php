<?php
require '../blocks/pre_head.php';
$page_title = "Рецепти";

use App\Models\Recipe;
use App\Models\RecipeCategory;

$recipe = Recipe::find(3);
$recipe_info = $recipe->info();
require '../blocks/head.php';
$ingredients = $recipe->ingredients();
$image_url = "";
if ($recipe->image_url != '') $image_url = 'style="background-image:url(\'' . $recipe->image_url . '\');"';
else $image_url = "";

?>
<div class="card card-recipe <?= $recipe->category()->name ?>" id="<?= $recipe->id ?>" name_of_dish="<?= str_replace(" ", "_ ", $recipe->title) ?>" weight_of_dish="<?= $recipeWeight  ?>" price_of_dish="<?= $recipePrice  ?>" kkal_of_dish="<?= $recipe_kcal  ?>" protein_of_dish="<?= $recipe_protein  ?>" carb_of_dish="<?= $recipe_carb  ?>" fat_of_dish="<?= $recipe_fat  ?>">
    <div class="card-recipe-back" <?= $image_url ?>></div>
    <div class="card-recipe-data">
        <table>
            <colgroup>
                <col span="1" style="width: 17%;">
                <col span="1" style="width: 8%;">
                <col span="1" style="width: 12.5%;">
                <col span="1" style="width: 12.5%;">
                <col span="1" style="width: 12.5%;">
                <col span="1" style="width: 12.5%;">
                <col span="1" style="width: 12.5%;">
                <col span="1" style="width: 12.5%;">
            </colgroup>
            <thead>
                <tr>
                    <th>
                        <img class="type-dish" src="../../assets/images/recipe_categories/<?= $recipe->category()->name ?>.png" alt="<?= $recipe->category()->name ?>">
                    </th>
                    <th>
                        <?= $recipe->title ?>
                    </th>
                    <th>
                        <?= $recipe->price() ?>грн
                    </th>
                    <th>
                        <?= $recipe->weight() ?>г
                    </th>
                    <th class="recipe-col-3">
                        <?= $recipe_kcal = $recipe_info["kcal"] ?>к
                    </th>
                    <th class="recipe-col-3">
                        <?= $recipe_protein = $recipe_info['protein'] ?>г
                    </th>
                    <th class="recipe-col-3">
                        <?= $recipe_fat = $recipe_info['fat'] ?>г
                    </th>
                    <th class="recipe-col-3">
                        <?= $recipe_carb = $recipe_info['carb'] ?>г
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<?php

require '../blocks/fotter.php';

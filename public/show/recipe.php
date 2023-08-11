<?php

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Recipe;
use App\Models\RecipeCategory;

$recipe = Recipe::find($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title><?= $recipe->title ?></title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php'
    ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="recipes_page">
                <div class="row-reverse w-full m-3 p-3">
                    <button class="btn" onclick="location.href='../pages/recipes.php'">До рецептів</button>
                </div>
                <div class="card w-full m-3 p-3 col">
                    <h1><?= $recipe->title ?></h1>
                    <div class="row j-c-be">
                        <div class="border border-double p-2 m-2">
                            <img src="<?= $recipe->image_url ?>" alt="">
                        </div>
                        <div class="p-2 m-2 w-fill">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>К-сть порцій:</td>
                                        <td><?= $recipe->portions ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ціна:</td>
                                        <td><?= $recipe->price() ?> грн</td>
                                    </tr>
                                    <tr>
                                        <td>Вага:</td>
                                        <td><?= $recipe->weight() ?> г</td>
                                    </tr>
                                    <tr>
                                        <td>Ккалорії:</td>
                                        <td><?= $recipe->info()['kcal'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Жири:</td>
                                        <td><?= $recipe->info()['fat'] ?> г</td>
                                    </tr>
                                    <tr>
                                        <td>Білки:</td>
                                        <td><?= $recipe->info()['protein'] ?> г</td>
                                    </tr>
                                    <tr>
                                        <td>Вуглеводи:</td>
                                        <td><?= $recipe->info()['carb'] ?> г</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row j-c-be">

                        <div class="p-2 m-2">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Інгрідієнт</th>
                                        <th>Вага</th>
                                        <th>Ціна</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recipe->ingredients() as $ingredient) { ?>
                                        <tr>
                                            <td><?= $ingredient->product()->title ?></td>
                                            <td><?= $ingredient->weight ?></td>
                                            <td><?= $ingredient->price() ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-2 m-3">
                            <p><?= $recipe->description ?></p>
                        </div>
                        <div class="border border-double p-2 m-3">
                            <a href="<?= $recipe->video_url ?>">Посилання на відео</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
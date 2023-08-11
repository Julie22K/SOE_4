<?php require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Recipe;
use App\Models\RecipeCategory; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Рецепти</title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php'
    ?>
    <script>
        $(document).ready(function() {
            $("#srch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#dishes div").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="recipes_page">
                <div class="card-header w-full m-3" id="recipes_header">
                    <div class="anti-card recipes-header-side col w-full m-3 p-2" id="filterSort">
                        <ion-icon class="icon-setting m-2" onclick="changeViewSide('setting','recipes-header-side','recipes_header')" name="settings-outline"></ion-icon>
                        <div class="filter border-line-bottom w-full m-2" id="filter">
                            <h3>Filter:</h3>

                            <div class="row row-wrap">
                                <button onclick="filterSelection('all')" class="btn btn-filter-sort m-2 active">All</button>
                                <?php $categories = RecipeCategory::all();
                                foreach ($categories as $c) { ?>
                                    <button onclick="filterSelection('<?= $c->name ?>')" class="btn btn-filter-sort m-2">
                                        <?= $c->name ?></button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="sort border-line-bottom w-full m-2">
                            <h3>Sort:</h3>
                            <div class="row row-wrap">
                                <button onclick="sort_recipes('name_of_dish','#sortRecipeByName')" id="sortRecipeByName" class="btn m-2 btn-filter-sort active card-recipe-sort">A..Z</button>
                                <button onclick="sort_recipes('weight_of_dish','#sortRecipeByWht')" id="sortRecipeByWht" class="btn m-2 btn-filter-sort card-recipe-sort">Weight</button>
                                <button onclick="sort_recipes('price_of_dish','#sortRecipeByPrice')" id="sortRecipeByPrice" class="btn m-2 btn-filter-sort card-recipe-sort">Price</button>
                                <button onclick="sort_recipes('kkal_of_dish','#sortRecipeByKKAL')" id="sortRecipeByKKAL" class="btn m-2 btn-filter-sort card-recipe-sort">KKAL</button>
                                <button onclick="sort_recipes('protein_of_dish','#sortRecipeByCarb')" id="sortRecipeByCarb" class="btn m-2 btn-filter-sort card-recipe-sort">Carbonation</button>
                                <button onclick="sort_recipes('carb_of_dish','#sortRecipeByFat')" id="sortRecipeByFat" class="btn m-2 btn-filter-sort card-recipe-sort">fat</button>
                                <button onclick="sort_recipes('fat_of_dish','#sortRecipeByProtein')" id="sortRecipeByProtein" class="btn m-2 btn-filter-sort card-recipe-sort">protein</button>
                            </div>
                        </div>
                        <div class="search w-full m-2 col" id="search_form">
                            <h3>Search:</h3> 
                                    <span class="row">
                                        <input type="search" class="m-2" id="srch" placeholder="search..." name="searchField" disabled>
                                        <input type="submit" class="btn btn-search m-2" value="Search" onclick="show()" disabled>
                                    </span>
                        </div>

                    </div>

                    <div class="anti-card recipes-header-side col w-full m-3" id="setting" style="display: none">

                        <ion-icon class="icon-setting m-2" onclick="changeViewSide('filterSort','recipes-header-side','recipes_header')" name="settings-outline"></ion-icon>

                        <div class="w-full m-2">

                            <h3>Setting:</h3>
                            <div class="row" id="columns_nums">
                                <button class="btn btn-setting m-2" id="btn_column_2" onclick="recipesListView(2,this.id)">2 columns</button>
                                <button class="btn btn-setting m-2 active" id="btn_column_3" onclick="recipesListView(3,this.id)">3 columns</button>
                                <button class="btn btn-setting m-2" id="btn_column_4" onclick="recipesListView(4,this.id)">4 columns</button>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="add">
                        <button onclick="location.href='Addrecipe.php'">Add recipe</button>
                    </div> -->
                </div>
                <div class="anti-card grid grid-3 w-full m-3" id="recipes_list">
                    <div onclick="location.href='../add/recipe.php'" class="add-card add-card-recipe">
                        <h6>Додати рецепт</h6>
                    </div>
                    <!--copy-->
                    <?php $recipes = Recipe::all();
                    foreach ($recipes as $recipe) {
                        $ingredients = $recipe->ingredients();
                        $image_url = ""; //opacity: 0.8; if ($recipe->image_url != '') $image_url = 'style="background-image:url(\'' . $recipe->image_url . '\');"'; else $image_url = ""; 
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
                                                <?= $recipe->title ?></th>
                                            <th>
                                                <?= $recipe->price() ?>грн</th>
                                            <th>
                                                <?= $recipe->weight() ?>г</th>
                                            <th class="recipe-col-3">
                                                <?= $recipe_kcal = $recipe->info()['kcal'] ?>к</th>
                                            <th class="recipe-col-3">
                                                <?= $recipe_protein = $recipe->info()['protein'] ?>г</th>
                                            <th class="recipe-col-3">
                                                <?= $recipe_fat = $recipe->info()['fat'] ?>г</th>
                                            <th class="recipe-col-3">
                                                <?= $recipe_carb = $recipe->info()['carb'] ?>г</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ingredients as $ingredient) { ?>
                                            <tr>
                                                <td>
                                                    <img class="type-food" src="../../assets/images/product_categories/<?= $ingredient->product()->category()->name ?>.png" alt="<?= $ingredient->product()->category()->name ?>">
                                                </td>
                                                <td>
                                                    <?= $ingredient->product()->title ?></td>
                                                <th>
                                                    <?= $ingredient->price() ?>грн</th>
                                                <th>
                                                    <?= $ingredient->weight ?>г</th>
                                                <th class="recipe-col-3">
                                                    <?= $ingredient->info()['kcal'] ?>к</th>
                                                <th class="recipe-col-3">
                                                    <?= $ingredient->info()['protein'] ?>г</th>
                                                <th class="recipe-col-3">
                                                    <?= $ingredient->info()['fat'] ?>г</th>
                                                <th class="recipe-col-3">
                                                    <?= $ingredient->info()['carb'] ?>г</th>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>

                    <!--here-->
                </div>
                <div class="page_navigation"></div>
            </div>
        </div>
    </div>
    <div class="context-menu-open" id="context_menu_recipe_card"></div>
    <script>
        changeViewSide('filterSort', 'recipes-header-side', 'recipes_header')

        function changeViewSide(id, c, p_id) {
            $('.' + c).css('display', 'none');
            $("#" + id).css('display', 'block');
            //$('#'+p_id).css('max-height',parseInt(document.getElementById(id).height)+30+"px");
        }

        function recipesListView(num, btn_id) {
            let container = $("#recipes_list");
            container.removeClass('grid-2');
            container.removeClass('grid-3');
            container.removeClass('grid-4');
            container.addClass('grid-' + num);
            $('#columns_nums .btn-setting').removeClass('active');
            $('#' + btn_id).addClass('active')
        }
    </script>

    <script>
        //modal

        function openModalChooseDaT(id) {
            openModal('myModalChooseDaT');
            $('#recipe_id_chooseDaT').val(id);
        }

        function ReadDescriptionRecipe(recipe_id) {
            openModal('myModalMedia');
            $('#myModalMedia h3').text('Description of the recipe:')
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                $('#modal_content').html('<p>' + this.responseText + '</p>');
            }
            xmlhttp.open("GET", "php_ajax/get_description_recipe.php?id=" + recipe_id);
            xmlhttp.send();

        }

        function WatchVideoRecipe(recipe_id) {
            openModal('myModalMedia');
            $('#myModalMedia h3').text('Video-recipe:')
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                $('#modal_content').html(this.responseText);
            }
            xmlhttp.open("GET", "php_ajax/get_video_recipe.php?id=" + recipe_id);
            xmlhttp.send();
        }
    </script>
    <script>
        //pagination
        document.onreadystatechange = function() {
            if (document.readyState === "complete") {

                var example_3 = new purePajinate({
                    containerSelector: '#recipes_list',
                    itemSelector: '.card-recipe',
                    navigationSelector: '.page_navigation',
                    wrapAround: true,
                    pageLinksToDisplay: 10,
                    itemsPerPage: 11,
                    startPage: 0
                });
            }
        };
        //elems on page:11(+'add'),23,23+12,23+12*2
    </script>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
    <script src="../../assets/js/dishes.js"></script>
    <script src="../../assets/js/sort/sort_recipe.js"></script>
    <script src="../../assets/js/delete_recipe.js"></script>
</body>

</html>
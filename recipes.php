<?php
require_once 'config/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>
    <style>
        /*.card-dish{
            position:relative;
        }
        .card-back{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 3;
            filter: blur(0.5px);
            background-size: cover;
            opacity: 0.6;
        }
        .card .data{
            position: absolute;
            top: 0;
            left: 0;
            z-index: 4;
        }*/
    </style>
    <title>Recipes</title>

</head>

<body>
    <?php require_once 'blocks/preloader.php' ?>
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
        <?php require_once 'blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php' ?>
            <div class="page" id="recipes_page">
                <div class="card-header m-x-0 p-x-0" id="recipes_header">
                    <div class="anti-card recipes-header-side col" id="filterSort">
                        <ion-icon class="icon-setting" onclick="changeViewSide('setting','recipes-header-side','recipes_header')" name="settings-outline"></ion-icon>
                        <div class="filter border-line-bottom p-b-2" id="filter">
                            <h3>Filter:</h3>

                            <div class="row row-wrap">
                                <button onclick="filterSelection('all')" class="btn btn-filter-sort active">All</button>
                                <?php

                                foreach ($type_dish as $td) {
                                    ?>
                                    <button onclick="filterSelection('<?= $td ?>')" class="btn btn-filter-sort"><?= $td ?></button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="sort border-line-bottom p-b-2 m-t-2">
                            <h3>Sort:</h3>
                            <div class="row row-wrap">
                                <button onclick="sort_recipes('name_of_dish','#sortRecipeByName')" id="sortRecipeByName" class="btn btn-filter-sort active card-recipe-sort">A..Z</button>
                                <button onclick="sort_recipes('weight_of_dish','#sortRecipeByWht')" id="sortRecipeByWht" class="btn btn-filter-sort card-recipe-sort">Weight</button>
                                <button onclick="sort_recipes('price_of_dish','#sortRecipeByPrice')" id="sortRecipeByPrice" class="btn btn-filter-sort card-recipe-sort">Price</button>
                                <button onclick="sort_recipes('kkal_of_dish','#sortRecipeByKKAL')" id="sortRecipeByKKAL" class="btn btn-filter-sort card-recipe-sort">KKAL</button>
                                <button onclick="sort_recipes('protein_of_dish','#sortRecipeByCarb')" id="sortRecipeByCarb" class="btn btn-filter-sort card-recipe-sort">Carbonation</button>
                                <button onclick="sort_recipes('carb_of_dish','#sortRecipeByFat')" id="sortRecipeByFat" class="btn btn-filter-sort card-recipe-sort">fat</button>
                                <button onclick="sort_recipes('fat_of_dish','#sortRecipeByProtein')" id="sortRecipeByProtein" class="btn btn-filter-sort card-recipe-sort">protein</button>
                            </div>
                        </div>
                        <form class="search " id="search_form">
                            <h3>Search: <label>
                                    <span class="row">
                                        <input type="search" id="srch" placeholder="search..." name="searchField" disabled>

                                    <input type="submit" class="btn btn-search" value="Search" onclick="show()" disabled>
                                    </span>

                        </form>
                    </div>
                    <div class="anti-card recipes-header-side col" id="setting" style="display: none">
                        <ion-icon class="icon-setting" onclick="changeViewSide('filterSort','recipes-header-side','recipes_header')" name="settings-outline"></ion-icon>
                        <div class="col">
                            <h3>Setting:</h3>
                            <div class="row" id="columns_nums">
                                <button class="btn btn-setting" id="btn_column_2" onclick="recipesListView(2,this.id)">2 columns</button>
                                <button class="btn btn-setting active" id="btn_column_3" onclick="recipesListView(3,this.id)">3 columns</button>
                                <button class="btn btn-setting" id="btn_column_4" onclick="recipesListView(4,this.id)">4 columns</button>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="add">
                        <button onclick="location.href='Addrecipe.php'">Add recipe</button>
                    </div> -->
                </div>
                <div class="anti-card grid grid-3 m-x-0 p-x-0" id="recipes_list">
                    <div onclick="location.href='Addrecipe.php'" class="add-card add-card-recipe">
                        <h6>Add recipe</h6>
                    </div>
                    <!--copy-->
                    <?php
                    $recipes = mysqli_query($soe,"SELECT * FROM recipes ORDER BY Name");
                    $recipes = mysqli_fetch_all($recipes);
                    foreach ($recipes as $recipe) {
                        $ingrs = mysqli_query($soe, "SELECT * FROM recipes,ingridients,products WHERE recipes.ID=ingridients.RecipeID AND products.ID=ingridients.ProductID AND recipes.Name='$recipe[1]';");
                        $ingrs = mysqli_fetch_all($ingrs);
                        $recipePrice = 0;
                        $recipeWeight = 0;
                        $recipe_kkal = 0;
                        $recipe_protein = 0;
                        $recipe_fat = 0;
                        $recipe_carb = 0;
                        foreach ($ingrs as $ingr) {
                            $recipePrice += $ingr[7] * $ingr[13] / 100;
                            $recipe_kkal += $ingr[7] * $ingr[15] / 100;
                            $recipe_protein += $ingr[7] * $ingr[17] / 100;
                            $recipe_fat += $ingr[7] * $ingr[16] / 100;
                            $recipe_carb += $ingr[7] * $ingr[18] / 100;
                            $recipeWeight += $ingr[7];
                        }
                        $image_url = '';
                        //opacity: 0.8;
                        if ($recipe[3] != '')  $image_url = 'style="background-image:url(\'' . $recipe[3] . '\');"';
                        else $image_url="";

                        ?>
                        <div class="card card-recipe <?= $recipe[2] ?>" id="<?= $recipe[0] ?>"  name_of_dish="<?= str_replace(" ", "_", $recipe[1]) ?>" weight_of_dish="<?= $recipeWeight  ?>" price_of_dish="<?= $recipePrice  ?>" kkal_of_dish="<?= $recipe_kkal  ?>" protein_of_dish="<?= $recipe_protein  ?>" carb_of_dish="<?= $recipe_carb  ?>" fat_of_dish="<?= $recipe_fat  ?>">
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
                                        <th><img class="type-dish" src="image/typeofdishes/<?= $recipe[2] ?>.png" alt="[dish]"></th>
                                        <th><?= $recipe[1] ?></th>
                                        <th><?= $recipePrice  ?>$</th>
                                        <th><?= $recipeWeight  ?>g</th>
                                        <th class="recipe-col-3"><?= $recipe_kkal  ?>kkal</th>
                                        <th class="recipe-col-3"><?= $recipe_protein  ?>g</th>
                                        <th class="recipe-col-3"><?= $recipe_fat ?>g</th>
                                        <th class="recipe-col-3"><?= $recipe_carb  ?>g</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    foreach ($ingrs as $ingr) {
                                        ?>
                                        <tr>
                                            <td><img class="type-food" src="image/groups/<?= $ingr[12] ?>.png" alt="<?= $ingr[12] ?>.png"></td>
                                            <td><?= $ingr[11] ?></td>
                                            <th><?= $ingr[7] * $ingr[13] / 100 ?>$</th>
                                            <th><?= $ingr[7] ?>g</th>
                                            <th class="recipe-col-3"><?= $ingr[7] * $ingr[15] / 100 ?>kkal</th>
                                            <th class="recipe-col-3"><?= $ingr[7] * $ingr[17] / 100 ?>g</th>
                                            <th class="recipe-col-3"><?= $ingr[7] * $ingr[16] / 100 ?>g</th>
                                            <th class="recipe-col-3"><?= $ingr[7] * $ingr[18] / 100 ?>g</th>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <!--here-->
                </div>
                <div class="page_navigation"></div>
            </div>
        </div>
    </div>
    <div class="context-menu-open" id="context_menu_recipe_card"></div>
    <div id="myModalChooseDaT" class="modal">
        <span class="close">&times;</span>
        <div class="modal-content" id=modal-content>
            <div class="modal-header" style="border: none">
                <h3>Choose day and time:</h3>
            </div>
            <div class="modal-body">
                <form action="vendor/Create_menucell.php" method="post" id="ch-mn">
                    <input style="display: none;" type="number" value="" id="recipe_id_chooseDaT" name="recipe_id_chooseDaT">
                    <table class="menu">
                        <thead>
                        <tr>
                            <th></th>
                            <th>mn</th>
                            <th>ts</th>
                            <th>wd</th>
                            <th>th</th>
                            <th>fr</th>
                            <th>st</th>
                            <th>sn</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Br</th>
                            <td class="daymenu"><input type="checkbox" name="Monday[]" value="Breakfast" class="tgl tgl-flip" id="bm"><label class="tgl-btn" for="bm"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Tuesday[]" value="Breakfast" class="tgl tgl-flip" id="bt"><label class="tgl-btn" for="bt"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Wednesday[]" value="Breakfast" class="tgl tgl-flip" id="bw"><label class="tgl-btn" for="bw"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Thursday[]" value="Breakfast" class="tgl tgl-flip" id="bth"><label class="tgl-btn" for="bth"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Friday[]" value="Breakfast" class="tgl tgl-flip" id="bf"><label class="tgl-btn" for="bf"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Saturday[]" value="Breakfast" class="tgl tgl-flip" id="bst"><label class="tgl-btn" for="bst"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Sunday[]" value="Breakfast" class="tgl tgl-flip" id="bsn"><label class="tgl-btn" for="bsn"></label></td>
                        </tr>
                        <tr>
                            <th>Sn1</th>
                            <td class="daymenu"><input type="checkbox" name="Monday[]" value="Snack(1)" class="tgl tgl-flip" id="s1m"><label class="tgl-btn" for="s1m"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Tuesday[]" value="Snack(1)" class="tgl tgl-flip" id="s1t"><label class="tgl-btn" for="s1t"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Wednesday[]" value="Snack(1)" class="tgl tgl-flip" id="s1w"><label class="tgl-btn" for="s1w"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Thursday[]" value="Snack(1)" class="tgl tgl-flip" id="s1th"><label class="tgl-btn" for="s1th"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Friday[]" value="Snack(1)" class="tgl tgl-flip" id="s1f"><label class="tgl-btn" for="s1f"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Saturday[]" value="Snack(1)" class="tgl tgl-flip" id="s1st"><label class="tgl-btn" for="s1st"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Sunday[]" value="Snack(1)" class="tgl tgl-flip" id="s1sn"><label class="tgl-btn" for="s1sn"></label></td>
                        </tr>
                        <tr>
                            <th>Ln</th>
                            <td class="daymenu"><input type="checkbox" name="Monday[]" value="Lunch" class="tgl tgl-flip" id="lm"><label class="tgl-btn" for="lm"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Tuesday[]" value="Lunch" class="tgl tgl-flip" id="lt"><label class="tgl-btn" for="lt"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Wednesday[]" value="Lunch" class="tgl tgl-flip" id="lw"><label class="tgl-btn" for="lw"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Thursday[]" value="Lunch" class="tgl tgl-flip" id="lth"><label class="tgl-btn" for="lth"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Friday[]" value="Lunch" class="tgl tgl-flip" id="lf"><label class="tgl-btn" for="lf"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Saturday[]" value="Lunch" class="tgl tgl-flip" id="lst"><label class="tgl-btn" for="lst"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Sunday[]" value="Lunch" class="tgl tgl-flip" id="lsn"><label class="tgl-btn" for="lsn"></label></td>
                        </tr>
                        <tr>
                            <th>Sn2</th>
                            <td class="daymenu"><input type="checkbox" name="Monday[]" value="Snack(2)" class="tgl tgl-flip" id="s2m"><label class="tgl-btn" for="s2m"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Tuesday[]" value="Snack(2)" class="tgl tgl-flip" id="s2t"><label class="tgl-btn" for="s2t"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Wednesday[]" value="Snack(2)" class="tgl tgl-flip" id="s2w"><label class="tgl-btn" for="s2w"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Thursday[]" value="Snack(2)" class="tgl tgl-flip" id="s2th"><label class="tgl-btn" for="s2th"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Friday[]" value="Snack(2)" class="tgl tgl-flip" id="s2f"><label class="tgl-btn" for="s2f"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Saturday[]" value="Snack(2)" class="tgl tgl-flip" id="s2st"><label class="tgl-btn" for="s2st"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Sunday[]" value="Snack(2)" class="tgl tgl-flip" id="s2sn"><label class="tgl-btn" for="s2sn"></label></td>
                        </tr>
                        <tr>
                            <th>Dn</th>
                            <td class="daymenu"><input type="checkbox" name="Monday[]" value="Dinner" class="tgl tgl-flip" id="dm"><label class="tgl-btn" for="dm"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Tuesday[]" value="Dinner" class="tgl tgl-flip" id="dt"><label class="tgl-btn" for="dt"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Wednesday[]" value="Dinner" class="tgl tgl-flip" id="dw"><label class="tgl-btn" for="dw"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Thursday[]" value="Dinner" class="tgl tgl-flip" id="dth"><label class="tgl-btn" for="dth"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Friday[]" value="Dinner" class="tgl tgl-flip" id="df"><label class="tgl-btn" for="df"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Saturday[]" value="Dinner" class="tgl tgl-flip" id="dst"><label class="tgl-btn" for="dst"></label></td>
                            <td class="daymenu"><input type="checkbox" name="Sunday[]" value="Dinner" class="tgl tgl-flip" id="dsn"><label class="tgl-btn" for="dsn"></label></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" class="btn">Add</button>
                        <button type="button" class="btn btn-cancel" onclick="closeModal('myModalChooseDaT')">Close</button>
                    </div>
                </form>
            </div><!--
            <div class="modal-footer">
                <div class="btn" onclick="closeModalAndAdd()">Add</div>
                <div class="btn btn-cancel" onclick="closeModal()">Close</div>
            </div>-->

        </div>
    </div>
    <div id="myModalDeleteRecipe" class="modal">
        <div class="modal-content" id=modal-content>
            <div class="modal-header">
                <h3>Delete recipe:</h3>
            </div>
            <div class="modal-body row">
                <ion-icon name="warning-outline" class="icon-clr-warning icon-size-big"></ion-icon>
                <p>Are you sure you want to delete the recipe? All dishes associated with it will also be deleted.</p>
            </div>
            <div class="modal-footer">
                <button class="btn" onclick="delete_yes()">Yes</button>
                <button class="btn btn-cancel" onclick="delete_no()">No</button>
            </div>

        </div>
    </div>
    <div id="myModalMedia" class="modal">
        <div class="modal-content" id=modal-content>
            <div class="modal-header">
                <h3>Video-recipe:</h3>
            </div>
            <div class="modal-body" id="modal_content">

            </div>
            <div class="modal-footer row-reverse">
                <button class="btn btn-cancel" onclick="closeModal('myModalMedia')">Close</button>
            </div>

        </div>
    </div>
    <script>
        changeViewSide('filterSort','recipes-header-side','recipes_header')
        function changeViewSide(id,c,p_id) {
            $('.'+c).css('display','none');
            $("#"+id).css('display','block');
            //$('#'+p_id).css('max-height',parseInt(document.getElementById(id).height)+30+"px");
        }
        function recipesListView(num,btn_id) {
            let container=$("#recipes_list");
            container.removeClass('grid-2');
            container.removeClass('grid-3');
            container.removeClass('grid-4');
            container.addClass('grid-'+num);
            $('#columns_nums .btn-setting').removeClass('active');
            $('#'+btn_id).addClass('active')
        }
    </script>

    <script src="js/modal.js"></script>
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
                $('#modal_content').html('<p>'+ this.responseText+'</p>');
            }
            xmlhttp.open("GET", "php_ajax/get_description_recipe.php?id="+recipe_id );
            xmlhttp.send();

        }
        function WatchVideoRecipe(recipe_id) {
            openModal('myModalMedia');
            $('#myModalMedia h3').text('Video-recipe:')
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                $('#modal_content').html(this.responseText);
            }
            xmlhttp.open("GET", "php_ajax/get_video_recipe.php?id="+recipe_id );
            xmlhttp.send();
        }



        /*var modal = document.getElementById("Modal");
        var span = document.getElementsByClassName("close")[0];
        var formmenu = document.getElementById("ch-mn");

        function chooseday(id) {
            modal.style.display = "block";
            $('#id').val(id);
        }

        function showimage(url) {
            modal.style.display = "block";
            $('#modal-content').empty();
            let li = '<img src="' + url + '" alt="src">'
            $('#modal-content').html(li);
        }

        function showvideo(url) {
            modal.style.display = "block";
            $('#modal-content').empty();
            let li = '<a href="' + url + '">' + url + '</a>'
            $('#modal-content').html(li);
        }

        function showrecipe(text) {
            modal.style.display = "block";
            $('#modal-content').empty();
            let li = '<p>' + text + '</p>'
            $('#modal-content').html(li);
        }
        span.onclick = function() {
            modal.style.display = "block";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
/!*
        function fun1() {
            var rad = document.getElementsByName('r1');
            for (var i = 0; i < rad.length; i++) {
                if (rad[i].checked) {
                    alert('Выбран ' + i + ' radiobutton');
                }
            }
        }*!/*/
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

    <script src="js/purePajinate.es5.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/contextmenu.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>
    <script src="js/dishes.js"></script>
    <script src="js/sort_recipe.js"></script>
    <script src="js/delete_recipe.js"></script>
</body>

</html>
<?php
require_once 'config/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XWZ14BWCYX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XWZ14BWCYX');
    </script>
    <?php require_once 'blocks/head.php' ?>
    <link rel="stylesheet" href="CSS/dishes.css" type="text/css" />
    <link rel="stylesheet" href="CSS/table.css" type="text/css" />
    <link rel="stylesheet" href="CSS/forms.css" type="text/css" />
    <link rel="stylesheet" href="CSS/modal.css" type="text/css" />
    <link rel="stylesheet" href="CSS/pagination.css" type="text/css" />
    <link rel="stylesheet" href="CSS/filtersort.css" type="text/css" />
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
            <div class="page">
                <div class="card filter-sort setting">
                    <ion-icon id="settingRecipe" name="settings-outline" onclick="changeside()"></ion-icon>
                    <div class="face">
                        <div class="filter" id="filter">
                            <?php

                            foreach ($typedish as $td) {
                            ?>
                                <button onclick="filterSelection('<?= $td ?>')" class="carddishSort active"><?= $td ?></button>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="sort">
                            <button onclick="sort_recipes('name_of_dish','#sortRecipeByName')" id="sortRecipeByName" class="active sort-recipe">A..Z</button>
                            <button onclick="sort_recipes('weight_of_dish','#sortRecipeByWht')" id="sortRecipeByWht" class="sort-recipe">Weight</button>
                            <button onclick="sort_recipes('price_of_dish','#sortRecipeByPrice')" id="sortRecipeByPrice" class="sort-recipe">Price</button>
                            <button onclick="sort_recipes('kkal_of_dish','#sortRecipeByKKAL')" id="sortRecipeByKKAL" class="sort-recipe">KKAL</button>
                            <button onclick="sort_recipes('protein_of_dish','#sortRecipeByCarb')" id="sortRecipeByCarb" class="sort-recipe">Carbonation</button>
                            <button onclick="sort_recipes('carb_of_dish','#sortRecipeByFat')" id="sortRecipeByFat" class="sort-recipe">fat</button>
                            <button onclick="sort_recipes('fat_of_dish','#sortRecipeByProtein')" id="sortRecipeByProtein" class="sort-recipe">protein</button>
                        </div>
                        <div class="search">
                            <input type="text" id="srch" placeholder="search...">

                        </div>
                    </div>
                    <div class="addition">
                        <h3>Setting:</h3>

                          <input type="radio" id="2colrecipes" name="numcolrecipes" value="2col">
                          <label style="vertical-align: super;" for="2colrecipes">2 columns</label>
                          <input type="radio" id="3colrecipes" name="numcolrecipes" value="3col">
                          <label for="3colrecipes">3 columns</label>
                          <input type="radio" id="4colrecipes" name="numcolrecipes" value="4col">
                          <label for="4colrecipes">4 columns</label>

                    </div>

                    <!-- <div class="add">
                        <button onclick="location.href='Addrecipe.php'">Add recipe</button>
                    </div> -->
                </div>
                <div class="container" id="listrecipes">
                    <div onclick="location.href='Addrecipe.php'" class="card none">
                        <div class="card-add">
                            <h6>Add recipe</h6>
                        </div>
                    </div>
                    <?php
                    $recipes = mysqli_query($soe, "SELECT * FROM `recipes`");
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
                        if ($recipe[3] != '')  $image_url = 'style="background-size: cover;background-image:url(' . $recipe[3] . ');"';

                    ?>
                        <div class="card card-dish <?= $recipe[2] ?>" id="<?= $recipe[0] ?>" <?= $image_url ?> name_of_dish="<?= str_replace(" ", "_", $recipe[1]) ?>" weight_of_dish="<?= $recipeWeight  ?>" price_of_dish="<?= $recipePrice  ?>" kkal_of_dish="<?= $recipe_kkal  ?>" protein_of_dish="<?= $recipe_protein  ?>" carb_of_dish="<?= $recipe_carb  ?>" fat_of_dish="<?= $recipe_fat  ?>">
                            <div class="data">
                                <table>
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
                </div>
            </div>
        </div>
    </div>
    <div class="context-menu-open" id="contextmenurecipecard"></div>
    <div id="Modal" class="modal">
        <span class="close">&times;</span>
        <!-- Modal content -->
        <div class="modal-content" id=modal-content>
            <form action="vendor/Create_menucell.php" method="post" id="ch-mn">
                <input style="display: none;" type="number" value="" id="id" name="recipe_id">
                <table class="menu">
                    <caption>choose day and time</caption>
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
                <button type="submit">Add dish</button>
            </form>
        </div>
    </div>
    <script>
        var modal = document.getElementById("Modal");
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

        function fun1() {
            var rad = document.getElementsByName('r1');
            for (var i = 0; i < rad.length; i++) {
                if (rad[i].checked) {
                    alert('Выбран ' + i + ' radiobutton');
                }
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/recipes_setting.js"></script>
    <script src="js/navbar.js"></script>
    <!-- <script src="js/pagination.js"></script> -->
    <script src="js/contextmenu.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>
    <script src="js/dishes.js"></script>
    <script src="js/sort_recipe.js"></script>



</body>

</html>
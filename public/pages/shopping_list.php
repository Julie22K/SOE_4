<?php require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\Menu;
use App\Models\Product; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Список покупок</title>
</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' 
    ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="shopping_list_page">
                <?php $menu_id = ($_GET['id']);
                $menu = Menu::find($menu_id); ?>
                <h1>Меню з <?= $menu->first_date ?> по <?= $menu->last_date ?></h1>
                <?php require 'parts/finanse.php'; ?>
                <div class="anti-card row m-3 w-full j-c-be">

                    <?php require 'parts/buttons_menu.php'; ?>
                    <!--<a class="btn m-2 p-2" href="../pages_add/dish.php">Add dish</a>-->
                </div>
                <?php require 'parts/shoplist/list.php'; ?>
            </div>
        </div>
    </div>

    <script>

        $('.horizontal .progress-fill span').each(function() {
            var percent = $(this).html();
            $(this).parent().css('width', percent);
        });
    </script>



    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
    <script src="../../assets/js/shoplist.js"></script>
    <script src="../../assets/js/sort_recipe.js"></script>
</body>

</html>
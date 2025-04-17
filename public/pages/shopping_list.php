<?php
require '../blocks/pre_head.php'; 
$page_title = "Список покупок";

use App\Models\Menu;

require '../blocks/head.php';
?>
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

<?php require '../blocks/fotter.php'; ?>
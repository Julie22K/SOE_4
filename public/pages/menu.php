<?php
require '../blocks/pre_head.php'; 
$page_title = "Menu of week";

use App\Models\Manufacturer;
use App\Models\Menu;

require '../blocks/head.php';
?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="page" id="menu_page">
    <?php $menu_id = ($_GET['id']);
    $menu = Menu::find($menu_id); ?>
    <?php require_once 'parts/finanse.php' ?>
    <?php require_once 'parts/menu/info.php'; ?>
    <div class="anti-card row m-3 w-full j-c-ar">
        <?php require_once 'parts/buttons_menu.php'; ?>
        <button class="btn btn btn-cancel m-2" style="width: 25%;" onclick="location.href='../../vendor/menu/clear.php?id=<?= $menu->id ?>'">Очистити меню</button>
        <!--<a class="btn m-2 p-2" href="../pages_add/dish.php">Add dish</a>-->
    </div>
    <?php require_once 'parts/menu/table.php' ?>
</div>

<?php require_once '../blocks/fotter.php'; ?>

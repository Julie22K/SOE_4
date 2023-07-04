<?php require_once 'C:\Users\Dell\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Menu; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'C:\Users\Dell\source\SOE_4\public\blocks/head.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Menu of week</title>
</head>

<body oncontextmenu="return false;">
    <?php //require_once 'C:\Users\Dell\source\SOE_4\public\blocks/preloader.php'; 
    ?>
    <div class="container">
        <?php require_once 'C:\Users\Dell\source\SOE_4\public\blocks/header.php'; ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'C:\Users\Dell\source\SOE_4\public\blocks/topbar.php'; ?>
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

        </div>
    </div>

    <div class="context-menu-open"></div>

    <script src="../../assets/js/modal.js"></script>

    <?php require_once 'C:\Users\Dell\source\SOE_4\public\blocks/fotter.php'; ?>

</body>

</html>
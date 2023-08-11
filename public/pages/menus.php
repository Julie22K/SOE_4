<?php require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Shop; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Список меню</title>
</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php'
    ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page">
                <h1>Список меню</h1>
                <div class="row-reverse m-3">
                    <button class="btn" onclick="location.href='../add/menu.php'">Додати меню</button>

                </div>
                <div class="anti-card grid grid-4 m-3">

                    <?php $menus = Menu::all();
                    foreach ($menus as $menu) { ?>
                        <div class="card card-menu col m-2 p-3" id="<?= $menu->id ?>">
                            <h3 class="m-3 p-b-3 border-bottom">З <?= $menu->first_date ?> по <?= $menu->last_date ?></h3>
                            <ul class="col m-3 list-none">
                                <li>
                                    <b>Бюджет:</b>
                                    <?= $menu->budget ?> грн
                                </li>
                                <li>
                                    <b>Особи:</b>
                                    <ul class=" list-numeric">
                                        <?php if (!empty($menu->persons())) {
                                            foreach ($menu->persons() as $person) { ?>
                                                <li class="m-l-5">
                                                    <?= $person->name ?></li>
                                        <?php }
                                        } ?>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <div class="context-menu-open" id="contextmenuperson"></div>


    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
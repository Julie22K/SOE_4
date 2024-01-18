<?php require_once 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\Menu;
?>
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
                    $months=Data::$months;
                    foreach ($menus as $menu) { 
                        
                    $year1=date("Y",strtotime($menu->first_date));
                    $year2=date("Y",strtotime($menu->last_date));
                    if($year1==$year2) $year1="";

                    $month1=$months[date("n",strtotime($menu->first_date))];
                    $month2=$months[date("n",strtotime($menu->last_date))];
                    if($month1==$month2) $month1="";

                    $first_date=date("j",strtotime($menu->first_date)) . " " . $month1 . " " . $year1;
                    $last_date=date("j",strtotime($menu->last_date)) . " " . $month2 . " " . $year2;

                    $word="";
                    $count_persons=count($menu->persons());
                    if($count_persons==1) $word="особу";
                    else if($count_persons>=2&&$count_persons<=4) $word="особи";
                    else $word="осіб";
                    $persons_title="Розраховано на " . $count_persons . " " . $word . ":";
                        ?>
                        <div class="card card-menu col m-2 p-3" id="<?= $menu->id ?>">
                            <h3 class="m-3 p-b-3 border-bottom">З <?= $first_date ?> по <?=  $last_date ?></h3>
                            <ul class="col m-3 list-none">
                                <li>
                                    <b>Бюджет:</b>
                                    <?= $menu->budget ?> грн
                                </li>
                                <li>
                                    <b><?=$persons_title?></b>
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
<?php

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\Menu;
use App\Models\Person;
$id=0;
$is_add_page=true;
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $is_add_page=false;
}
$menu_=Menu::find($id);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title><?= $is_add_page?"Додати меню":"Редагування меню"?></title>
</head>

<body oncontextmenu="return false;">

    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page">
                <h1><?= $is_add_page?"Додавання меню:":"Редагування меню:"?></h1>
                <form action="../../vendor/menu/<?=$is_add_page?'store.php':'update.php?id=' . $id?>" method="post">
                    <div class="col">
                        <div class="row j-c-be">
                            <div class="m-3 w-half">
                                <label for="budget">Бюджет:</label>
                                <input type="text" name="budget" id="budget" <?=$is_add_page?'':'value="' . $menu_->budget . '"'?>>
                            </div>
                            <div class="m-3 w-half">
                                <label for="persons">Особи:</label>
                                <select class="select2" name="persons[]" id="persons" multiple="multiple">
                                    <?php
                                    $persons = Person::all();
                                    foreach ($persons as $person) {
                                        $is_selected="";
                                        if(!$is_add_page){
                                            
                                            foreach($menu_->persons() as $p){
                                                if($person->id==$p->id) $is_selected="selected";
                                            }
                                        }
                                    ?>
                                        <option value="<?= $person->id ?>" <?=$is_selected?>><?= $person->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row j-c-be">
                            <div class="m-3 w-half">
                                <label for="first_date">Початок:</label>
                                <input type="date" name="first_date" id="first_date" <?=$is_add_page?'':'value="' . $menu->first_date . '"'?>>
                            </div>
                            <div class="m-3 w-half">
                                <label for="last_date">Кінець:</label>
                                <input type="date" name="last_date" id="last_date" <?=$is_add_page?'':'value="' . $menu->last_date . '"'?>>
                            </div>
                        </div>


                        <div class="row j-c-be">
                            <button type="submit" class="btn btn-save"><?=$is_add_page?"Додати":"Зберегти"?></button>
                            <button type="button" class="btn btn-cancel" onclick="location.href='../pages/menus.php'">Повернутись</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
<?php

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Person;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Додати меню</title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page">
                <h1>Додавання меню:</h1>
                <form action="../../vendor/menu/store.php" method="post">
                    <div class="col">
                        <div class="row j-c-be">
                            <div class="m-3 w-half">
                                <label for="budget">Бюджет:</label>
                                <input type="text" name="budget" id="budget">
                            </div>
                            <div class="m-3 w-half">
                                <label for="persons">Особи:</label>
                                <select class="select2" name="persons[]" id="persons" multiple>
                                    <?php
                                    $persons = Person::all();
                                    foreach ($persons as $person) {
                                    ?>
                                        <option value="<?= $person->id ?>"><?= $person->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row j-c-be">
                            <div class="m-3 w-half">
                                <label for="first_date">Початок:</label>
                                <input type="date" name="first_date" id="first_date">
                            </div>
                            <div class="m-3 w-half">
                                <label for="last_date">Кінець:</label>
                                <input type="date" name="last_date" id="last_date">
                            </div>
                        </div>


                        <div class="row j-c-be">
                            <button type="submit" class="btn btn-save">Додати</button>
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
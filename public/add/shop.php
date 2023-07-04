<?php

require 'C:\Users\Dell\source\SOE_4\public\blocks/pre_head.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/head.php' ?>
    <title>Add dish</title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page">
                <h1>Додавання магазину:</h1>
                <form action="../../vendor/shop/store.php" method="post">
                    <div class="col">
                        <div class="m-3">
                            <label for="name">Назва:</label>
                            <input type="text" name="name" id="name">
                        </div>
                        <div class="row j-c-be">
                            <div class=" m-3 w-half">
                                <label for="phone">Телефон:</label>
                                <input type="text" name="phone" id="phone">
                            </div>
                            <div class="m-3 w-half">
                                <label for="address">Адреса:</label>
                                <input type="text" name="address" id="address">
                            </div>
                        </div>

                        <div class="row j-c-be">
                            <button type="submit" class="btn btn-save">Додати</button>
                            <button type="button" class="btn btn-cancel" onclick="location.href='../pages/shops.php'">Повернутись</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
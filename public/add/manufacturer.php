<?php

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Додавання виробника</title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page">
                <h1>Додавання виробника:</h1>
                <form action="../../vendor/manufacturer/store.php" method="post">
                    <div class="col">
                        <div class="m-3">
                            <label for="name">Назва:</label>
                            <input type="text" name="name" id="name">
                        </div>

                        <?php
                        if (isset($_SESSION['errors'])) {
                            foreach ($_SESSION['errors'] as $error)
                                echo '<p class="error"> ' . $error . ' </p>';
                        }
                        unset($_SESSION['errors']);
                        ?>
                        <div class="row j-c-be">
                            <button type="submit" class="btn btn-save">Додати</button>
                            <button type="button" class="btn btn-cancel"
                                onclick="location.href='../pages/manufacturers.php'">Повернутись</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
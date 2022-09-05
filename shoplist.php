<?php
require_once 'config/connect.php';
require_once 'config/get.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>
    <link rel="stylesheet" href="CSS/shoplist.css" type="text/css" />
    <title>Shopping list</title>

</head>

<body>
    <?php require_once 'blocks/preloader.php' ?>
    <div class="container">
        <?php require_once 'blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php' ?>
            <div class="page">
                <div class="finanse"></div>
                <div class="container" id="shoplist">
                    <?php
                    foreach ($types as $type) {
                    ?>
                        <ul>
                            <?php
                            $shoplist = mysqli_query($soe, "SELECT * FROM shoplist,dishes,recipes,ingridients,products WHERE dishes.ID=shoplist.DishID AND ingridients.ID=shoplist.IngridientID AND ingridients.ProductID=products.ID AND dishes.RecipeID=recipes.ID AND products.type='$type';");
                            $shoplist = mysqli_fetch_all($shoplist);
                            if (count($shoplist) != 0) echo '<h6><img class="product-icon" src="image/groups/' . $type . '.png" alt="' . $type . '">' . $type . '</h6>';
                            foreach ($shoplist as $item) {
                                $done = ($item[1] == '0') ? 'todo' : 'done';
                            ?>
                                <li class="<?= $done ?>" id="<?= $item[0] ?>">

                                    <small style="color:grey;"><?= $item[9] ?></small> <?= $item[19] ?> - <?= $item[15] ?>г (<?= $item[15] * $item[21] / 100 ?>грн)
                                </li>
                        <?php
                            }
                        }
                        ?>
                        <!-- <p style="cursor: pointer;" onclick="location.href='Addshoplist.php'">+Add</p> -->

                        </ul>
                </div>
            </div>

        </div>
    </div>
    <script>
        let lists = document.querySelectorAll('#shoplist ul li');

        function donetask() {
            this.classList.remove('todo');
            this.classList.add('done');
        }

        function returntask() {
            this.classList.remove('done');
            this.classList.add('todo');
        }
        lists.forEach((item) =>
            item.addEventListener('click', donetask));
        lists.forEach((item) =>
            item.addEventListener('dblclick', returntask));
    </script>



    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/contextmenu.js"></script>
    <script src="js/color.js"></script>
    <script src="js/shoplist.js"></script>
    <script src="js/sort_recipe.js"></script>
</body>

</html>
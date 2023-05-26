<?php
require_once 'config/connect.php';
require_once 'config/get.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'blocks/head.php' ?>
    <title>Shopping list</title>
</head>
<body>
    <?php require_once 'blocks/preloader.php' ?>
    <div class="container">
        <?php require_once 'blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php' ?>
            <div class="page" id="shopping_list_page">
                <div class="anti-card" id="finance">
                    <?php
                    $finance_max=1000;
                    $finance = mysqli_query($soe, "SELECT sum(i.weight),sum(p.price100g) FROM shoplist as s,dishes as d,recipes as r,ingridients as i,products as p WHERE d.ID=s.DishID AND i.ID=s.IngridientID AND i.ProductID=p.ID AND d.RecipeID=r.ID;");
                    $finance = mysqli_fetch_all($finance);
                    $finance_val = $finance[0][0] * $finance[0][1] / 100;
                    ?>
                    <div class="progress">
                                <div class="progress-bar" style="width:<?=$finance_val*100/$finance_max?>%;">
                                    <span class="text-center"><?=round($finance_val*100/$finance_max,2)?>%</span>
                                </div>
                    </div>


                </div>
                <div class="anti-card" id="shopping_list">
                    <?php
                    foreach ($types as $type) {


                        $shoplist = mysqli_query($soe, "SELECT min(s.id),p.name,sum(i.weight),sum(p.price100g) FROM shoplist as s,dishes as d,recipes as r,ingridients as i,products as p WHERE d.ID=s.DishID AND i.ID=s.IngridientID AND i.ProductID=p.ID AND d.RecipeID=r.ID AND p.type='$type' GROUP BY p.name;");
                        $shoplist = mysqli_fetch_all($shoplist);

                        if(count($shoplist) != 0) echo '<table id="table_' . $type . '"><caption onclick="ToggleSubList(\'table_' . $type . '\')"><h3><img class="product-icon" src="image/groups/' . $type . '.png" alt="' . $type . '">' . $type . '</h3></caption>';
                        else echo '<table id="table_' . $type . '" class="hiden-element">';
                        foreach ($shoplist as $item) {
                            ?>
                            <tr id="shop_item_<?= $item[0] ?>">
                                <td class="check"><input type="checkbox" value="<?= $item[0] ?>"></td>
                                <td class="name"><?= $item[1] ?></td>
                                <td class="dish"></td>
                                <td class="weight"><?= $item[2] ?> г</td>
                                <td class="price"><?= $item[2] * $item[3] / 100 ?> грн</td>
                            </tr>
                            <?php
                        }
                        echo '</table>';
                    }
                    ?>
                        <!-- <p style="cursor: pointer;" onclick="location.href='Addshoplist.php'">+Add</p> -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function ToggleSubList(id){
            $("#"+id+" tr").toggle(500);
        }

        $('.horizontal .progress-fill span').each(function(){
            var percent = $(this).html();
            $(this).parent().css('width', percent);
        });
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
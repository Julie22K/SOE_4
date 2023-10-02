<?php

use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Shop;

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

$shop_id = 0;
$manufacturer_id = 0;
$product_id = 0;
if (isset($_GET['shop'])) $shop_id = $_GET['shop'];
if (isset($_GET['product'])) $product_id = $_GET['product'];

if (isset($_GET['manufacturer'])) $manufacturer_id = $_GET['manufacturer'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Додати ціну</title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page">
                <h1>Додавання ціни:</h1>
                <form action="../../vendor/price/store.php" method="post">
                    <div class="col">
                        <div class="m-3">
                            <label for="product">Продукт:</label>
                            <select class="select2 m-2" name="product" id="product">
                                <option value="0" <?= $product_id == "" ? "selected" : "" ?>>Оберіть продукт</option>
                                <?php
                                $products = Product::all();
                                foreach ($products as $product) {
                                ?>
                                    <option value="<?= $product->id ?>" <?= ($product_id == $product->id) ? "selected" : "" ?>><?= $product->title ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row j-c-be">
                            <div class="m-3 w-half">
                                <label for="price">Ціна:</label>
                                <input type="number" min="0" name="price" id="price">
                            </div>
                            <div class="m-3 w-half">
                                <label for="weight">Вага:</label>
                                <input type="number" min="0" name="weight" id="weight">
                            </div>
                        </div>

                        <div class="row j-c-be">
                            <div class=" m-3 w-half">
                                <label for="shop">Магазин:</label>
                                <select class="select2 m-2" name="shop" id="shop">
                                    <option value="0" <?= $shop_id == "" ? "selected" : "" ?>>Оберіть магазин</option>
                                    <?php
                                    $shops = Shop::all();
                                    foreach ($shops as $shop) {
                                    ?>
                                        <option value="<?= $shop->id ?>" <?= ($shop_id == $shop->id) ? "selected" : "" ?>><?= $shop->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="m-3 w-half">
                                <label for="manufacturer">Виробник:</label>
                                <select class="select2 m-2" name="manufacturer" id="manufacturer">
                                    <option value="0" <?= $manufacturer_id == "" ? "selected" : "" ?>>Оберіть виробника</option>
                                    <?php
                                    $manufacturers = Manufacturer::all();

                                    foreach ($manufacturers as $manufacturer) {
                                    ?>
                                        <option value="<?= $manufacturer->id ?>" <?= ($manufacturer_id == $manufacturer->id) ? "" : "" ?>><?= $manufacturer->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                            if ($_SESSION['errors']) {
                                foreach($_SESSION['errors'] as $error)
                                    echo '<p class="error"> ' . $error . ' </p>';
                            }
                            unset($_SESSION['errors']);
                        ?>
                        <div class="row j-c-be">
                            <button type="submit" class="btn btn-save">Додати</button>
                            <button type="button" class="btn btn-cancel" onclick="location.href='../pages/shops.php'">Повернутись</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
<?php

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Product;
use App\Models\Recipe;
use App\Models\RecipeCategory;

$product = Product::find($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title><?= $product->title ?></title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php'
    ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="recipes_page">
                <div class="row-reverse w-full m-3 p-3">
                    <button class="btn" onclick="location.href='../pages/products.php'">До списку продуктів</button>
                </div>
                <div class="card w-full m-3 p-3 col">
                    <h1><?= $product->title ?></h1>
                    <div class="row j-c-be w-full">
                        <?php
                        if ($product->image_url != "") {
                        ?>
                            <div class="border border-double p-2 m-2">
                                <img src="<?= $product->image_url ?>" alt="">
                            </div>
                        <?php
                        }
                        ?>
                        <div class="border p-2 m-2 col j-c-be w-inherit">
                            <table class="m-2 p-2">
                                <thead class="border-bottom">
                                    <td>Ціна</td>
                                    <td>Вага</td>
                                    <td>Магазин</td>
                                    <td>Виробник</td>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($product->prices() as $price) {
                                    ?>
                                        <tr>
                                            <td><?= $price->price ?> грн</td>
                                            <td><?= $price->weight ?> г</td>
                                            <td><?= $price->shop()->name ?></td>
                                            <td><?= $price->manufacturer()->name ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <button class="btn btn-cancel m-2 p-2" onclick="location.href='../add/price.php?product=<?= $product->id ?>'">Додати ціну</button>

                        </div>
                    </div>
                    <div class="row j-c-be w-full">
                        <div class="border p-2 m-2 w-half">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Ккалорії:</td>
                                        <td><?= $product->product_data['kcal'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Жири:</td>
                                        <td><?= $product->product_data['fat'] ?> г</td>
                                    </tr>
                                    <tr>
                                        <td>Білки:</td>
                                        <td><?= $product->product_data['protein'] ?> г</td>
                                    </tr>
                                    <tr>
                                        <td>Вуглеводи:</td>
                                        <td><?= $product->product_data['carb'] ?> г</td>
                                    </tr>
                                    <tr>
                                        <td>Вода:</td>
                                        <td><?= $product->product_data['water'] ?> мл</td>
                                    </tr>
                                    <tr>
                                        <td>Клітковина:</td>
                                        <td><?= $product->product_data['cellulose'] ?> г</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border p-2 m-2 w-half">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Вітамін A:</td>
                                        <td><?= $product->product_data['vitA'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін E:</td>
                                        <td><?= $product->product_data['vitE'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін K:</td>
                                        <td><?= $product->product_data['vitK'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін D:</td>
                                        <td><?= $product->product_data['vitD'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін C:</td>
                                        <td><?= $product->product_data['vitC'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Омега-3:</td>
                                        <td><?= $product->product_data['om3'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Омега-6:</td>
                                        <td><?= $product->product_data['om6'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B1:</td>
                                        <td><?= $product->product_data['vitB1'] ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row j-c-be w-full">

                        <div class="border p-2 m-2 w-half">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Вітамін B2:</td>
                                        <td><?= $product->product_data['vitB2'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B5:</td>
                                        <td><?= $product->product_data['vitB5'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B6:</td>
                                        <td><?= $product->product_data['vitB6'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B8:</td>
                                        <td><?= $product->product_data['vitB8'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B9:</td>
                                        <td><?= $product->product_data['vitB9'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B12:</td>
                                        <td><?= $product->product_data['vitB12'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Магній (Mg):</td>
                                        <td><?= $product->product_data['minMg'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Натрій (Na):</td>
                                        <td><?= $product->product_data['minNa'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border p-2 m-2 w-half">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Кальцій (Ca):</td>
                                        <td><?= $product->product_data['minCa'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Хлор (Cl):</td>
                                        <td><?= $product->product_data['minCl'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Калій (K):</td>
                                        <td><?= $product->product_data['minK'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Сульфур (S):</td>
                                        <td><?= $product->product_data['minS'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Фосфор (P):</td>
                                        <td><?= $product->product_data['minP'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Йод (I):</td>
                                        <td><?= $product->product_data['minI'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Купрум (Cu):</td>
                                        <td><?= $product->product_data['minCu'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Хром (Cr):</td>
                                        <td><?= $product->product_data['minCr'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
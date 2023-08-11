<?php require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Manufacturer; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Виробники</title>
</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="shopping_list_page">
                <h1>Виробники</h1>
                <div class="row w-full j-c-be m-3 p-3">
                    <button class="btn btn-cancel" onclick="location.href='../pages/products.php'">До списку продуктів</button>
                    <button class="btn" onclick="location.href='../add/manufacturer.php'">Додати виробника</button>
                </div>
                <div class="card w-full m-3 p-3">
                    <table>
                        <thead>
                            <tr>
                                <th>Назва</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $manufacturers = Manufacturer::all();
                            foreach ($manufacturers as $manufacturer) {
                                $items_list = '';
                                $prices = $manufacturer->prices();
                                foreach ($prices as $price) {
                                    $product = $price->product()->title;
                                    $weight = $price->weight;
                                    $price_ = $price->price;
                                    $shop = $price->shop()->name;
                                    $items_list = "$items_list<li>$product - $price_ грн/$weight г ($shop)</li>";
                                }
                                $items_list = '<ul>' . $items_list . '</ul>'; ?>
                                <tr>
                                    <td>
                                        <?= $manufacturer->name ?></td>
                                    <td>
                                        <button class="btn btn-cancel" onclick="Modal.simple('Список товарів від виробника \'<?= $manufacturer->name ?>\'','<?= $items_list ?>','location.href=\'../add/price.php?manufacturer=<?= $manufacturer->id ?>\'')">Переглянути товари</button>
                                        <button class="btn btn-cancel btn-small" onclick='location.href="#"'>Додати товар</button>
                                        <button class="btn btn-cancel btn-small" onclick='location.href="#"'>Редагувати</button>
                                        <button class="btn btn-cancel btn-small" onclick='location.href="../../vendor/manufacturer/delete.php?id=<?= $shop->id ?>"'>Видалити</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </ul>
                </div>
            </div>
        </div>
    </div>


    <?php require_once 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
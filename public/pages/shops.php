<?php require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Shop; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Магазини</title>
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
                <h1>Магазини</h1>
                <div class="row w-full j-c-be m-3 p-3">
                    <button class="btn btn-cancel" onclick="location.href='../pages/products.php'">До списку продуктів</button>
                    <button class="btn" onclick="location.href='../add/shop.php'">Додати магазин</button>
                </div>
                <div class="card m-3 p-3 w-full">
                    <table>
                        <thead>
                            <tr>
                                <th>Назва</th>
                                <th>Адреса</th>
                                <th>Телефон</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $shops = Shop::all();
                            foreach ($shops as $shop) {
                                $items_list = '';
                                $prices = $shop->prices();
                                foreach ($prices as $price) {
                                    $product = $price->product()->title;
                                    $weight = $price->weight;
                                    $price_ = $price->price;
                                    $manufacturer = $price->manufacturer()->name;
                                    $items_list = "$items_list<li>$product - $price_ грн/$weight г ($manufacturer)</li>";
                                }
                                $items_list = '<ul>' . $items_list . '</ul>'; ?>
                                <tr>
                                    <td>
                                        <?= $shop->name ?></td>
                                    <td>
                                        <?= $shop->address ?></td>
                                    <td>
                                        <?= $shop->phone ?></td>
                                    <td>
                                        <button class="btn btn-cancel" onclick="Modal.simple('Список товарів в магазині \'<?= $shop->name ?>\'','<?= $items_list ?>','location.href=\'../add/price.php?shop=<?= $shop->id ?>\'')">Переглянути товари</button>
                                        <button class="btn btn-cancel" onclick='location.href="#"'>Додати товар</button>
                                        <button class="btn btn-cancel" onclick='location.href="#"'>Редагувати</button>
                                        <button class="btn btn-cancel" onclick='location.href="../../vendor/manufacturer/delete.php?id=<?= $shop->id ?>"'>Видалити</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </ul>
                </div>
            </div>
        </div>
    </div>

    <?php require 'C:\Users\Julie\source\SOE_4\public/modals/example.php'; ?>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>

</body>

</html>
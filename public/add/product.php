<?php

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shop;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php';
    ?>
    <title>Додавання продукту</title>
</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="page_add_product">
                <h1>Додавання продукту:</h1>
                <form action="../../vendor/product/store.php" method="post" id="form_add_product">
                    <div class="" id="title">
                        <Label for="title">Назва:</Label>
                        <input type="text" name="title" id="title">
                    </div>
                    <div class="" id="category">
                        <Label for="category">Категорія:</Label>
                        <select class="select2-add m-2" name="category" id="category">
                            <?php
                            $categories = ProductCategory::all();

                            foreach ($categories as $category) {
                                ?>
                                <option value="<?= $category->id ?>">
                                    <?= $category->name ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="" id="is_private">
                        <label>Доступний іншим користувачам:</label>
                        <label class="switch">
                            <input type="checkbox" name="is_private">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col" id="price_list">
                        <div class="w-full" id="prices_list">


                            <!--<div class="grid">
                                        <h6>Ціна</h6>
                                        <h6>Вага</h6>
                                        <h6>Виробник</h6>
                                        <h6>Магазин</h6>
                                        <h6></h6>
                                    </div>-->
                            <div class="row j-c-ar a-items-baseline">
                                <input class="m-2" type="number" name="prices[]" placeholder="Ціна" min="0" step="0.01">
                                <input class="m-2" type="number" name="weights[]" placeholder="Вага (г)" min="0"
                                    step="1">
                                <select class="select2-add m-2" name="manufacturers[]" id="manufacturers">
                                    <?php
                                    $manufacturers = Manufacturer::all();

                                    foreach ($manufacturers as $manufacturer) {
                                        ?>
                                        <option value="<?= $manufacturer->id ?>">
                                            <?= $manufacturer->name ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <select class="select2-add m-2" name="shops[]" id="shops">
                                    <?php
                                    $shops = Shop::all();
                                    foreach ($shops as $shop) {
                                        ?>
                                        <option value="<?= $shop->id ?>">
                                            <?= $shop->name ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <button type="button" class="btn btn-delete m-2" onclick="deletePrice(this)">X</button>
                            </div>
                        </div>
                        <button class="btn m-2" type="button" onclick="addPrice(this)">Додати ціну
                            продукту</button>
                    </div>
                    <div class="add-card" id="add_image_url" style="height:150px"
                        onclick="Modal.for_form('image_url','modal_add_image_url','')">
                        <h6>Додати зображення</h6>
                    </div>
                    <input id="image_url" name="image_url" type="text" class="none-element int">

                    <div class="col a-items-stretch" id="vits_and_mins">
                        <div class="row j-c-be a-items-stretch">
                            <input class="m-2" type="number" step="0.001" name="kcal" placeholder="Kcal">
                            <input class="m-2" type="number" step="0.001" name="carb" placeholder="Carb">
                            <input class="m-2" type="number" step="0.001" name="fat" placeholder="Fat">
                            <input class="m-2" type="number" step="0.001" name="protein" placeholder="Protein">
                            <input class="m-2" type="number" step="0.001" name="water" placeholder="Water">
                            <input class="m-2" type="number" step="0.001" name="cellulose" placeholder="Cellulose">

                        </div>
                        <div class="row j-c-be a-items-stretch">
                            <input class="m-2" type="number" step="0.001" name="vitA" placeholder="A">
                            <input class="m-2" type="number" step="0.001" name="vitE" placeholder="E">
                            <input class="m-2" type="number" step="0.001" name="vitK" placeholder="K">
                            <input class="m-2" type="number" step="0.001" name="vitD" placeholder="D">
                            <input class="m-2" type="number" step="0.001" name="vitC" placeholder="C">
                            <input class="m-2" type="number" step="0.001" name="om3" placeholder="Omega-3">

                        </div>
                        <div class="row j-c-be">
                            <input class="m-2" type="number" step="0.001" name="om6" placeholder="Omega-6">
                            <input class="m-2" type="number" step="0.001" name="vitB1" placeholder="B1">
                            <input class="m-2" type="number" step="0.001" name="vitB2" placeholder="B2">
                            <input class="m-2" type="number" step="0.001" name="vitB5" placeholder="B5">
                            <input class="m-2" type="number" step="0.001" name="vitB6" placeholder="B6">
                            <input class="m-2" type="number" step="0.001" name="vitB8" placeholder="B8">

                        </div>
                        <div class="row j-c-be">
                            <input class="m-2" type="number" step="0.001" name="vitB9" placeholder="B9">
                            <input class="m-2" type="number" step="0.001" name="vitB12" placeholder="B12">
                            <input class="m-2" type="number" step="0.001" name="minMg" placeholder="Mg">
                            <input class="m-2" type="number" step="0.001" name="minNa" placeholder="Na">
                            <input class="m-2" type="number" step="0.001" name="minCl" placeholder="Cl">
                            <input class="m-2" type="number" step="0.001" name="minCa" placeholder="Ca">
                        </div>
                        <div class="row j-c-be">
                            <input class="m-2" type="number" step="0.001" name="minK" placeholder="K">
                            <input class="m-2" type="number" step="0.001" name="minS" placeholder="S">
                            <input class="m-2" type="number" step="0.001" name="minP" placeholder="P">
                            <input class="m-2" type="number" step="0.001" name="minCu" placeholder="Cu">
                            <input class="m-2" type="number" step="0.001" name="minI" placeholder="I">
                            <input class="m-2" type="number" step="0.001" name="minCr" placeholder="Cr">
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['errors'])) {
                        foreach ($_SESSION['errors'] as $error)
                            echo '<p class="error"> ' . $error . ' </p>';
                    }
                    unset($_SESSION['errors']);
                    ?>
                    <div class="row j-c-be" id="buttons">
                        <button type="submit" class="btn btn-save">Додати</button>
                        <button type="button" class="btn btn-cancel"
                            onclick="location.href='../pages/products.php'">Повернутись</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        var selectCounter = 1;
        function addPrice(list) {
            const prices_list = document.getElementById('prices_list');

            var elem = document.createElement('div');
            elem.className = 'row j-c-ar a-items-baseline';

            var inputPrice = document.createElement('input');
            inputPrice.className = 'm-2';
            inputPrice.type = 'number';
            inputPrice.name = 'prices[]';
            inputPrice.placeholder = 'Ціна';
            inputPrice.min = 0;
            inputPrice.step = 0.01;
            elem.appendChild(inputPrice);

            var inputWeight = document.createElement('input');
            inputWeight.className = 'm-2';
            inputWeight.type = 'number';
            inputWeight.name = 'weights[]';
            inputWeight.placeholder = 'Вага (г)';
            inputWeight.min = 0;
            inputWeight.step = 1;
            elem.appendChild(inputWeight);

            var selectManufacturer = document.createElement('select');
            selectManufacturer.id = 'select2_for_manufacturer_' + selectCounter; // Унікальний ідентифікатор
            selectManufacturer.className = 'select2-add m-2';
            selectManufacturer.name = 'manufacturers[]';
            <?php
            $manufacturers = Manufacturer::all(); foreach ($manufacturers as $manufacturer) {
                ?>
                var option = document.createElement('option');
                option.value = '<?= $manufacturer->id ?>';
                option.text = '<?= $manufacturer->name ?>';
                selectManufacturer.appendChild(option);
                <?php
            }
            ?>
            elem.appendChild(selectManufacturer);

            var selectShop = document.createElement('select');
            selectShop.id = 'select2_for_shop_' + selectCounter; // Унікальний ідентифікатор
            selectShop.className = 'select2-add m-2';
            selectShop.name = 'shops[]';
            <?php
            $shops = Shop::all();
            foreach ($shops as $shop) {
                ?>
                var option = document.createElement('option');
                option.value = '<?= $shop->id ?>';
                option.text = '<?= $shop->name ?>';
                selectShop.appendChild(option);
                <?php
            }
            ?>
            elem.appendChild(selectShop);

            var btn = document.createElement('button');
            btn.className = 'btn m-2';
            btn.textContent = 'X';
            btn.onclick = function () {
                deletePrice(this);
            };
            elem.appendChild(btn);

            prices_list.appendChild(elem);
            $('#select2_for_manufacturer_' + selectCounter).select2({
                theme: 'bootstrap4',
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Select an option'
                },

                tags: true,
            });
            $('#select2_for_shop_' + selectCounter).select2({
                theme: 'bootstrap4',
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Select an option'
                },
                tags: true,
            });
            selectCounter++;
        }

        const deletePrice = (elem) => elem.parentElement.remove();
    </script>



    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
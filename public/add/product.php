<?php

use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shop;

require '../blocks/pre_head.php';

if (isset($_SERVER['HTTP_REFERER'])) $_SESSION['PREV_PAGE']= $_SERVER['HTTP_REFERER'];

$page_type = "create";
if (isset($_SESSION['errors'])) $page_type = "error";
else if (isset($_GET['id'])) $page_type = "update";

$page_title = $page_type == "create" ? "Додавання продукту" : "Редагування продукту";

require '../blocks/head.php';
?>
<div class="page" id="page_add_product">
    <h1><?= $page_title ?></h1>
    <?php require '../blocks/errors.php'; ?>
    <form action="../../vendor/product/store.php" method="post" id="form_add_product" enctype="multipart/form-data">

        <div id="form_title">
            <Label for="title">Назва:</Label>
            <input type="text" name="title" id="title">
        </div>
        <div id="form_category">
            <Label for="category">Категорія:</Label>
            <select class="select2-add m-2 w-full" style="max-width: 100%;" name="category" id="category">
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
        <!-- <div class="add-card" id="add_image_url" style="height:150px"
                onclick="Modal.for_form('image_url','modal_add_image_url','')">
                <h6>Додати зображення</h6>
                </div> -->
        <div id="form_image">
            <Label for="image_url">Зображення:</Label>
            <input id="image_url" name="image_url" type="file" class="">
        </div>

        <div class="column a-items-baseline" id="form_is_private">
            <label>Не видимий іншим:</label><br>
            <label class="switch">
                <input type="checkbox" name="is_private">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="column" id="form_price_list">
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
                    <button type="button" class="btn btn-delete m-2" onclick="deletePrice(this)"><ion-icon name="close-outline"></ion-icon></button>
                </div>
            </div>
            <button class="btn m-2" type="button" onclick="addPrice(this)">Додати ціну</button>
        </div>
        <div class="col a-items-stretch" id="form_vits_and_mins">
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

        <div class="row j-c-be" id="form_buttons">
            <button type="submit" class="btn btn-save">Додати</button>
            <button type="button" class="btn btn-cancel"
                onclick="location.href='../pages/products.php'">Повернутись</button>
        </div>

    </form>
</div>
<?php require '../blocks/scripts/add_product.php'; ?>
<?php require '../blocks/fotter.php'; ?>
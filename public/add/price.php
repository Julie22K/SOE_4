<?php

require '../blocks/pre_head.php';

if (isset($_SERVER['HTTP_REFERER'])) $_SESSION['PREV_PAGE'] = $_SERVER['HTTP_REFERER'];

use App\Models\Shop;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductCategory;

$page_type = "store";
if (isset($_GET['type'])) $page_type = $_GET['type'];
$page_title = $page_type == "store" ? "Додавання ціни" : "Редагування ціни";

require '../blocks/head.php';

$shop_id = $_GET['shop'] ?? 0;
$manufacturer_id = $_GET['manufacturer'] ?? 0;
$product_id = $_GET['product'] ?? 0;
?>

<div class="page">
    <h1><?= $page_title ?></h1>
    <form action="../../vendor/price/<?= $page_type ?>.php" method="post">
        <!-- TODO: add is_private -->
        <div class="col">
            <div class="row j-c-be">
                <div class="m-3 w-half">
                    <label for="product_id">Продукт:</label>
                    <select class="select2 m-2" name="product_id" id="product_id">
                        <option value="0" <?= $product_id == "" ? "selected" : "" ?>>Оберіть продукт</option>
                        <?php
                        $product_categories = ProductCategory::all();
                        foreach ($product_categories as $product_category) {
                        ?>
                        <optgroup label="<?= $product_category->name ?>">
                        <?php
                        $products = Product::WhereAndOrderBy("(is_private=false OR (is_private=true AND user_id=$user_id)) AND product_category_id=$product_category->id", "title ASC");
                        foreach ($products as $product) {
                        ?>
                            <option value="<?= $product->id ?>" <?= ($product_id == $product->id) ? "selected" : "" ?>>
                                <?= $product->title ?>
                            </option>
                        <?php
                        }
                        ?>
                            </optgroup>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="m-3 w-half">
                    <div class="column a-items-baseline" id="form_is_private">
                        <label>Не видимий іншим:</label><br>
                        <label class="switch">
                            <input type="checkbox" name="is_private">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
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
                    <label for="shop_id">Магазин:</label>
                    <select class="select2-add m-2" name="shop_id" id="shop_id">
                        <option value="" <?= $shop_id == "" ? "selected" : "" ?>>Не вказувати</option>
                        <?php
                        $shops = Shop::all();
                        foreach ($shops as $shop) {
                        ?>
                            <option value="<?= $shop->id ?>" <?= ($shop_id == $shop->id) ? "selected" : "" ?>>
                                <?= $shop->name ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="m-3 w-half">
                    <label for="manufacturer_id">Виробник:</label>
                    <select class="select2-add m-2" name="manufacturer_id" id="manufacturer_id">
                        <option value="" <?= $manufacturer_id == "" ? "selected" : "" ?>>Не вказувати
                        </option>
                        <?php
                        $manufacturers = Manufacturer::all();
                        foreach ($manufacturers as $manufacturer) {
                        ?>
                            <option value="<?= $manufacturer->id ?>" <?= ($manufacturer_id == $manufacturer->id) ? "selected" : "" ?>>
                                <?= $manufacturer->name ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <?php
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $error)
                    echo '<p class="error"> ' . $error . ' </p>';
            }
            unset($_SESSION['errors']);
            ?>
            <div class="row j-c-be">
                <button type="submit" class="btn btn-save"><?= $page_type == 'store' ? 'Додати' : 'Зберегти'  ?></button>
                <button type="button" class="btn btn-cancel"
                    onclick="location.href='../pages/shops.php'">Повернутись</button>
            </div>
        </div>
    </form>
</div>

<?php require '../blocks/fotter.php'; ?>
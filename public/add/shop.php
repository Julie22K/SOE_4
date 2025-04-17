<?php

use App\Models\Shop;

require '../blocks/pre_head.php';

if (isset($_SERVER['HTTP_REFERER'])) $_SESSION['PREV_PAGE'] = $_SERVER['HTTP_REFERER'];

$page_type = "store";
// if (isset($_SESSION['errors'])) $page_type = "error"; // TODO: check if it works
if (isset($_GET['id'])) $page_type = "update";

$page_title = $page_type == "store" ? "Додавання магазину" : "Редагування магазину";

$shop=null;
if ($page_type == "update") $shop = Shop::find($_GET['id']);

$validate_data=null;
if(isset($_SESSION['validation_data'])){
    $shop=(object)$_SESSION['validation_data'];
    unset($_SESSION['validation_data']);
}


require '../blocks/head.php';
?>

<div class="page">
    <h1><?= $page_title ?></h1>
    <form action="../../vendor/shop/<?=$page_type?>.php<?=  isset($_GET['id']) ?  '?id=' . $_GET['id'] : '' ?>" method="post">
        <div class="col">
            <div class="row j-c-be">
                <div class="m-3" style="width: 66%;">
                    <label for="name">Назва:</label>
                    <input type="text" name="name" id="name" value="<?= $shop ? $shop->name : '' ?>">
                </div>
                <div class="m-3 w-third">
                    <div class="column a-items-baseline" id="form_is_private">
                        <label>Не видимий іншим:</label><br>
                        <label class="switch">
                            <input type="checkbox" name="is_private" value="1" <?= $shop && $shop->is_private ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row j-c-be">
                <div class=" m-3 w-half">
                    <label for="phone">Телефон:</label>
                    <input type="text" name="phone" id="phone" value="<?= $shop ? $shop->phone : '' ?>">
                </div>
                <div class="m-3 w-half">
                    <label for="address">Адреса:</label>
                    <input type="text" name="address" id="address" value="<?= $shop ? $shop->address : '' ?>">
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
                <button type="submit" class="btn btn-save"><?= $page_type=='store'?'Додати': 'Зберегти'?></button>
                <button type="button" class="btn btn-cancel"
                    onclick="location.href='../pages/shops.php'">Повернутись</button>
            </div>
        </div>
    </form>
</div>
<?php require '../blocks/fotter.php'; ?>
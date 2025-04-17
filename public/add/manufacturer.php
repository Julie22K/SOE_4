<?php

require '../blocks/pre_head.php';

use App\Models\Manufacturer;

if (isset($_SERVER['HTTP_REFERER'])) $_SESSION['PREV_PAGE'] = $_SERVER['HTTP_REFERER'];

$page_type = "store";
if (isset($_GET['id'])) $page_type = "update";

$page_title = $page_type == "store" ? "Додавання виробника" : "Редагування виробника";

$manufacturer = null;
if ($page_type == "update") $manufacturer = Manufacturer::find($_GET['id']);

$validate_data = null;
if (isset($_SESSION['validation_data'])) {
    $manufacturer = (object)$_SESSION['validation_data'];
    unset($_SESSION['validation_data']);
}


require '../blocks/head.php';
?>
<div class="page">
    <h1>Додавання виробника:</h1>
    <form action="../../vendor/manufacturer/<?=$page_type?>.php<?=  isset($_GET['id']) ?  '?id=' . $_GET['id'] : '' ?>" method="post">
        <div class="col">
        <div class="row j-c-be">
                <div class="m-3" style="width: 66%;">
                    <label for="name">Назва:</label>
                    <input type="text" name="name" id="name" value="<?= $manufacturer ? $manufacturer->name : '' ?>">
                </div>
                <div class="m-3 w-third">
                    <div class="column a-items-baseline" id="form_is_private">
                        <label>Не видимий іншим:</label><br>
                        <label class="switch">
                            <input type="checkbox" name="is_private" value="1" <?= $manufacturer && $manufacturer->is_private ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
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
                <button type="submit" class="btn btn-save">Додати</button>
                <button type="button" class="btn btn-cancel"
                    onclick="location.href='../pages/manufacturers.php'">Повернутись</button>
            </div>
        </div>
    </form>
</div>
<?php require '../blocks/fotter.php'; ?>
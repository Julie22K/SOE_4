<?php
require '../blocks/pre_head.php';
$page_title = "Виробники";

use App\Models\Manufacturer;

require '../blocks/head.php';
?>

<div class="page">
    <h1>Виробники</h1>
    <div class="row w-full j-c-be m-3 p-3">
        <button class="btn btn-cancel" onclick="location.href='../pages/products.php'">До списку продуктів</button>
        <button class="btn" onclick="location.href='../add/manufacturer.php'">Додати виробника</button>
    </div>
    <?php
    if (isset($_SESSION['messages']['success'])) {
    ?>
        <div class="success">
            <p><?= $_SESSION['messages']['success'] ?></p>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    <?php
    } else if (isset($_SESSION['messages']['danger'])) {
    ?>
        <div class="warning">
            <p><?= $_SESSION['messages']['danger'] ?></p>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    <?php

    }
    unset($_SESSION['messages']['danger']);
    unset($_SESSION['messages']['success']);
    ?>
    <div class="card w-full m-3 p-3">
        <table>
            <thead>
                <tr>
                    <th>Статус</th>
                    <th>Назва</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $user_id = $_SESSION['user']['id'];
                
                $manufacturers = Manufacturer::where(null, "user_id=$user_id OR (is_private=false AND user_id!=$user_id)");
                
                foreach ($manufacturers as $manufacturer) {
                ?>
                    <tr>
                        <td class="status-icon">
                            <?= ($manufacturer->is_private == true && $manufacturer->user_id == $user_id) ? '<ion-icon name="lock-closed-outline" title="Не доступний іншим користувачам"></ion-icon>' : '' ?>
                            <?= ($manufacturer->is_private == false && $manufacturer->user_id == $user_id) ? '<ion-icon name="lock-open-outline" title="Доступний іншим користувачам"></ion-icon>' : '' ?>
                            <?= ($manufacturer->is_private == false && $manufacturer->user_id != $user_id) ? '<ion-icon name="people-outline" title="Автор: ' . ($manufacturer->user() != null ? $manufacturer->user()->login : 'Admin') . '"></ion-icon>' : ''  ?>
                        </td>
                        <td>
                            <?= $manufacturer->name ?></td>
                        <td>
                            <button class="btn btn-with-icon" onclick="Modal.with_load_data('Список товарів від виробника \'<?= $manufacturer->name ?>\'','../../vendor/ajax/get_prices_by_manufacturer.php?manufacturer_id=<?= $manufacturer->id ?>','location.href=\'../add/price.php?manufacturer=<?= $manufacturer->id ?>\'')" title="Переглянути товари"><ion-icon name="reader-outline"></ion-icon></button>
                            <button class="btn btn-with-icon" onclick='location.href="../add/price.php?manufacturer=<?= $manufacturer->id ?>"' title="Додати товар"><ion-icon name="add-outline"></ion-icon></button>
                            <button class="btn btn-with-icon" onclick='location.href="../add/manufacturer.php?id=<?= $manufacturer->id ?>"' title="Редагувати магазин"><ion-icon name="create-outline"></ion-icon></button>
                            <button class="btn btn-with-icon" onclick="Modal.delete_alert('Ви впевненні, що хочете видалити цього виробника? Всі пов`язані з ним ціни будуть видалені.','manufacturer',<?= $manufacturer->id ?>)" title="Видалити магазин"><ion-icon name="close-outline"></ion-icon></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            </ul>
    </div>

    <?php require '../blocks/fotter.php'; ?>
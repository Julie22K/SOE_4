<?php
require '../blocks/pre_head.php';
$page_title = "Магазини";

use App\Models\Shop;

require '../blocks/head.php';
?>

<div class="page">
    <h1>Магазини</h1>
    <div class="row w-full j-c-be m-3 p-3">
        <button class="btn btn-cancel" onclick="location.href='../pages/products.php'">До списку продуктів</button>
        <button class="btn" onclick="location.href='../add/shop.php'">Додати магазин</button>
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
    <div class="card m-3 p-3 w-full column">

        <table>
            <thead>
                <tr>
                    <th>Статус</th>
                    <th>Назва</th>
                    <th>Адреса</th>
                    <th>Телефон</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['user']['id'];
                $shops = Shop::where(null, "user_id=$user_id OR (is_private=false AND user_id!=$user_id)");
                foreach ($shops as $shop) {
                    
                ?>
                    <tr>
                        <td class="status-icon">
                            <?= ($shop->is_private == true && $shop->user_id == $user_id) ? '<ion-icon name="lock-closed-outline" title="Не доступний іншим користувачам"></ion-icon>' : '' ?>
                            <?= ($shop->is_private == false && $shop->user_id == $user_id) ? '<ion-icon name="lock-open-outline" title="Доступний іншим користувачам"></ion-icon>' : '' ?>
                            <?= ($shop->is_private == false && $shop->user_id != $user_id) ? '<ion-icon name="people-outline" title="Автор: ' . ($shop->user() != null ? $shop->user()->login : 'Admin') . '"></ion-icon>' : ''  ?>
                        </td>
                        <td>
                            <?= $shop->name ?>
                        </td>
                        <td>
                            <?= $shop->address ?></td>
                        <td>
                            <?= $shop->phone ?></td>
                        <td>
                            <button class="btn btn-with-icon" onclick="Modal.with_load_data('Товари у магазині \'<?= $shop->name ?>\'','../../vendor/ajax/get_prices_by_shop.php?shop_id=<?=$shop->id?>','location.href=\'../add/price.php?shop=<?= $shop->id ?>\'')" title="Переглянути товари"><ion-icon name="reader-outline"></ion-icon></button>
                            <button class="btn btn-with-icon" onclick='location.href="../add/price.php?shop=<?= $shop->id ?>"' title="Додати товар"><ion-icon name="add-outline"></ion-icon></button>
                            <button class="btn btn-with-icon" onclick='location.href="../add/shop.php?id=<?= $shop->id ?>"' title="Редагувати магазин"><ion-icon name="create-outline"></ion-icon></button>
                            <button class="btn btn-with-icon" onclick="Modal.delete_alert('Ви впевненні, що хочете видалити цей магазин? Всі пов`язані з ним ціни будуть видалені.','shop',<?= $shop->id ?>)" title="Видалити магазин"><ion-icon name="close-outline"></ion-icon></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            </ul>
    </div>
</div>


<?php require '../blocks/fotter.php'; ?>
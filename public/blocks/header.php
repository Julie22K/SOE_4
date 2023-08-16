<?php

use App\Models\Menu;

$menu = Menu::current();

$menu_link = "";
$shopping_list_link = "";
//var_dump($menu);
if ($menu !== false && !is_null($menu)) {
    $menu_id = $menu->id;
    $menu_link = "../pages/menu.php?id=$menu_id";
    $shopping_list_link = "../pages/shopping_list.php?id=$menu_id";
} else {
    $menu_link = "../pages/menus.php";
    $shopping_list_link = "../pages/menus.php";
}
?>
<navbar>
    <div class="navigation">
        <ul>
            <li>
                <a href="../../index.php">
                    <span class="icon">
                        <ion-icon name="calendar-outline"></ion-icon>
                    </span>
                    <span class="title">Система харчування</span>
                </a>
            </li>
            <li class="pointer">
                <a href="<?= $menu_link ?>">
                    <span class="icon">
                        <ion-icon name="book-outline"></ion-icon>
                    </span>
                    <span class="title">Меню</span>

                </a>
            </li>
            <li class="pointer">
                <a href="<?= $shopping_list_link ?>">
                    <span class="icon">
                        <ion-icon name="basket-outline"></ion-icon>
                    </span>
                    <span class="title">Список покупок</span>
                </a>
            </li>
            <li class="pointer">
                <a href="../pages/recipes.php">
                    <span class="icon">
                        <ion-icon name="restaurant-outline"></ion-icon>
                    </span>
                    <span class="title">Рецепти</span>
                </a>
            </li>
            <li class="pointer">
                <a href="../pages/products.php">
                    <span class="icon">
                        <ion-icon name="nutrition-outline"></ion-icon>
                    </span>
                    <span class="title">Продукти</span>
                </a>
            </li>
            <li class="pointer">
                <a href="../pages/persons.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Користувачі</span>
                </a>
            </li>
            <li class="pointer">
                <a href="../pages/setting.php">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="title">Налаштування</span>
                </a>
            </li>
            
            <li style="margin-top: 120px;">
                <form>
                    <a href="../../vendor/logout.php" class="logout">
                        <span class="icon" title="Вийти за акаунту">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title" title="Вийти за акаунту <?= $_SESSION['user']['full_name'] ?>">Вихід</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</navbar>
<?php require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\MealTime;
use App\Models\Product; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php'; ?>
    <title>Головна</title>
</head>

<body oncontextmenu="return false;">


    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page">
                <h2>Вітаємо <?= $_SESSION['user']['full_name'] ?>!</h2>
                <p>На цьому додатку ви можете:</p>
                <ul>
                    <li>Створити своє меню</li>
                    <li>Відслідковувати його бюджет та користь для здоров'я</li>
                    <li>Переглядати список покупок після створення меню</li>
                    <li>Переглядати  рецепти інших користувачів або додавати свої</li>
                    <li>Корисне меню можна створити не лише для себе, а і для родини, близьких чи друзів</li>
                </ul>
            </div>
        </div>
    </div>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
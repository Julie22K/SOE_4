<?php
require '../blocks/pre_head.php';
$page_title = "Головна";
require '../blocks/head.php';
?>

<div class="page">
    <h2>Вітаємо <?= $_SESSION['user']['login'] ?>!</h2>
    <button class="btn" onclick="$('#text').slideToggle('slow')">деталі</button>
    <div id="text" style="display: none;">
        <p>На цьому додатку ви можете:</p>
        <ul>
            <li>Створити своє меню</li>
            <li>Відслідковувати його бюджет та користь для здоров'я</li>
            <li>Переглядати список покупок після створення меню</li>
            <li>Переглядати рецепти інших користувачів або додавати свої</li>
            <li>Корисне меню можна створити не лише для себе, а і для родини, близьких чи друзів</li>
        </ul>
    </div>
</div>

<?php require '../blocks/fotter.php'; ?>
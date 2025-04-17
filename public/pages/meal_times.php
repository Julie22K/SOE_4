<?php
require '../blocks/pre_head.php'; 
$page_title = "Редагування режиму харчування";

use App\Models\Manufacturer;
use App\Models\MealTime;

require '../blocks/head.php';
?>

<div class="page">
    <h1>Редагування режиму харчування</h1>
<!-- Виводиться список
 якщо статус "" -->
    <form class="w-full col" action="../../vendor/meal_time/store.php" method="post">
        <div class="card w-full m-3 p-3">

            <table class="w-full none-hover">
                <thead>
                    <tr>
                        <th class="w-20pr p-l-4">Пріорітет</th>
                        <th class="w-60pr p-l-4">Назва</th>
                        <th class="w-20pr">Використовувати</th>
                    </tr>
                </thead>
                <tbody id="myTable">


                </tbody>
            </table>
            <div id="ids" class="none-element">

            </div>
        </div>
        <?php
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error)
                echo '<p class="error"> ' . $error . ' </p>';
        }
        unset($_SESSION['errors']);
        ?>
        <div class="w-full m-3 p-3">
            <button type="submit" class="btn w-full">Зберегти</button>
        </div>
    </form>


    <?php require '../blocks/fotter.php'; ?>
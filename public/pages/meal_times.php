<?php require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Manufacturer;
use App\Models\MealTime; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Редагування режиму харчування</title>
</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="shopping_list_page">
                <h1>Редагування режиму харчування</h1>

                <form class="w-full col" action="../../vendor/meal_time/store.php" method="post">
                    <div class="card w-full m-3 p-3">

                        <table class="w-full none-hover">
                            <thead>
                                <tr>
                                    <th>Назва</th>
                                    <th>Пріорітет</th>
                                    <th>Дії</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">


                            </tbody>
                        </table>
                        <div id="ids" class="none-element">

                        </div>
                    </div>
                        <?php
                            if ($_SESSION['errors']) {
                                foreach($_SESSION['errors'] as $error)
                                    echo '<p class="error"> ' . $error . ' </p>';
                            }
                            unset($_SESSION['errors']);
                        ?>
                    <div class="w-full m-3 p-3">
                        <button type="submit" class="btn w-full">Зберегти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let data = [<?php
                    $meal_times = MealTime::all();
                    foreach ($meal_times as $meal_time) {
                    ?> {
                    id: <?= $meal_time->id ?>,
                    name: "<?= $meal_time->name ?>",
                    priority: "<?= $meal_time->priority ?>"
                },
            <?php
                    }
            ?>
        ]
        $(document).ready(function() {
            fillList();
        });

        function changePriorities(id, new_value) {

            old_value = data[id - 1].priority;
            data[id - 1].priority = new_value;
            data[id].priority = old_value;

            fillList();
        }

        function addMealTime() {
            let text = $("#add input")[0].value;
            let priority = $("#add input")[1].value;
            console.log(text);
            data.push({
                id: data.length + 1,
                name: text,
                priority: priority
            });
            fillList();

        }

        function deleteMealTime(id) {
            let new_data = data.filter(item => item.id != id);
            data = new_data;
            fillList();
        }

        function fillList() {
            const table = data.map((item) => {
                return '<tr id="' + item.id + '">' +
                    '<td><input class="fake" type="text" name="names[]" value="' + item.name + '"></td>' +
                    '<td><input class="fake" onchange="changePriorities(' + item.id + ',this.value)" type="number" step="1" min="1" name="priorities[]" value="' + item.priority + '"></td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-cancel btn-small" onclick=\'deleteMealTime(' + item.id + ')\'>Видалити</button>' +
                    '</td></tr>';
            });
            const addBtn = '<tr id="add"><td><input id="name" type="text" name="" value=""></td><td><input id="number" onchange="changePriorities()" type="number" step="1" min="1" name="" value="' + (data.length + 1) + '"></td><td><button type="button" class="btn btn-cancel btn-small" onclick="addMealTime()">Додати</button></td></tr>';
            const ids = data.map((item) => {
                return '<input type="text" name="ids[]" value="' + item.id + '">';
            });
            $('#ids').html(ids);
            $('#myTable').html(table + addBtn);
        }
    </script>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
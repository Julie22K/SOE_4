<?php

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\Product;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>

    <title>Add persons</title>
</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page">
                <h1>Додавання особи:</h1>
                <form action="../../vendor/person/store.php" method="post">
                    <div class="col">
                        <div class="row j-c-be">
                            <div class="w-half form-control">
                                <label for="name">Ім'я:</label>
                                <input type="text" name="name" id="name">
                            </div>
                            <div class="w-half form-control">
                                <legend>Стать:</legend>
                                <div class="row j-c-ev a-items-center">
                                    <div class="m-2">
                                        <input type="radio" id="woman" value="woman" name="gender" checked>
                                        <label for="woman">Жінка</label>
                                    </div>

                                    <div class="m-2">
                                        <input type="radio" id="man" value="man" name="gender">
                                        <label for="man">Чоловік</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row j-c-be">
                            <div class="w-half form-control">
                                <label for="date_of_birth">Дата народження:</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="2000-01-01">
                            </div>
                            <div class="w-half form-control">
                                <label for="activity">Рівень активності:</label>
                                <select name="activity" id="activity">
                                    <option value="" selected disabled>Оберіть рівень активнсті</option>
                                    <option value="1.2">1.2 (Мінімальна активність)</option>
                                    <option value="1.4">1.4 (Помірна активність)</option>
                                    <option value="1.55">1.55 (Середня активність)</option>
                                    <option value="1.7">1.7 (Висока активність)</option>
                                    <option value="1.9">1.9 (Дуже висока активність)</option>
                                </select>
                            </div>
                        </div>
                        <div class="row j-c-be">
                            <div class="w-half form-control">
                                <label for="height">Зріст:</label>
                                <input type="number" name="height" id="height" placeholder="Введіть зріст у сантиметрах" step="1" min="156">
                            </div>
                            <div class="w-half form-control">
                                <label for="weigth">Вага:</label>
                                <input type="number" name="weigth" id="weigth" placeholder="Введіть вагу у кілограмах" step="1" min="45">
                            </div>
                        </div>

                        <div class="row j-c-be button-row">
                            <button type="submit" class="btn btn-save">Додати</button>
                            <button type="button" class="btn btn-cancel" onclick="location.href='../pages/persons.php'">Повернутись</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const act = document.querySelector('#act');
        const output = document.querySelector('.price-output');

        output.textContent = act.value;

        act.addEventListener('input', function() {
            output.textContent = act.value;
        });
    </script>

    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
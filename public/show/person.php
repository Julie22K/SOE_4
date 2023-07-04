<?php

require 'C:\Users\Dell\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Person;

$person = Person::find($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/head.php' ?>
    <title><?= $person->name ?></title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/preloader.php'
    ?>
    <div class="container">
        <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="recipes_page">
                <div class="row-reverse w-full m-3 p-3">
                    <button class="btn" onclick="location.href='../pages/persons.php'">До списку осіб</button>
                </div>
                <div class="card w-full m-3 p-3 col">
                    <h1><?= $person->name ?></h1>

                    <div class="row j-c-be w-full">
                        <div class="border p-2 m-2 w-half">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Стать:</td>
                                        <td><?= $person->gender ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вік:</td>
                                        <td><?= $person->age() ?> р.</td>
                                    </tr>
                                    <tr>
                                        <td>Дата народження:</td>
                                        <td><?= $person->date_of_birth ?></td>
                                    </tr>
                                    <tr>
                                        <td>Зріст:</td>
                                        <td><?= $person->height ?> см</td>
                                    </tr>
                                    <tr>
                                        <td>Вага:</td>
                                        <td><?= $person->weight ?> кг</td>
                                    </tr>
                                    <tr>
                                        <td>Рівень активності:</td>
                                        <td><?= $person->activity ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border p-2 m-2 w-half">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Ккалорії:</td>
                                        <td><?= $person->person_data()['kcal'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Жири:</td>
                                        <td><?= $person->person_data()['fat'] ?> г</td>
                                    </tr>
                                    <tr>
                                        <td>Білки:</td>
                                        <td><?= $person->person_data()['protein'] ?> г</td>
                                    </tr>
                                    <tr>
                                        <td>Вуглеводи:</td>
                                        <td><?= $person->person_data()['carb'] ?> г</td>
                                    </tr>
                                    <tr>
                                        <td>Вода:</td>
                                        <td><?= $person->person_data()['water'] ?> мл</td>
                                    </tr>
                                    <tr>
                                        <td>Клітковина:</td>
                                        <td><?= $person->person_data()['cellulose'] ?> г</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row j-c-be w-full">
                        <div class="border p-2 m-2 w-third">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Вітамін A:</td>
                                        <td><?= $person->person_data()['vitA'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін E:</td>
                                        <td><?= $person->person_data()['vitE'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін K:</td>
                                        <td><?= $person->person_data()['vitK'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін D:</td>
                                        <td><?= $person->person_data()['vitD'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін C:</td>
                                        <td><?= $person->person_data()['vitC'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Омега-3:</td>
                                        <td><?= $person->person_data()['om3'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Омега-6:</td>
                                        <td><?= $person->person_data()['om6'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B1:</td>
                                        <td><?= $person->person_data()['vitB1'] ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="border p-2 m-2 w-third">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Вітамін B2:</td>
                                        <td><?= $person->person_data()['vitB2'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B5:</td>
                                        <td><?= $person->person_data()['vitB5'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B6:</td>
                                        <td><?= $person->person_data()['vitB6'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B8:</td>
                                        <td><?= $person->person_data()['vitB8'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B9:</td>
                                        <td><?= $person->person_data()['vitB9'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Вітамін B12:</td>
                                        <td><?= $person->person_data()['vitB12'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Магній (Mg):</td>
                                        <td><?= $person->person_data()['minMg'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Натрій (Na):</td>
                                        <td><?= $person->person_data()['minNa'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border p-2 m-2 w-third">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Кальцій (Ca):</td>
                                        <td><?= $person->person_data()['minCa'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Хлор (Cl):</td>
                                        <td><?= $person->person_data()['minCl'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Калій (K):</td>
                                        <td><?= $person->person_data()['minK'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Сульфур (S):</td>
                                        <td><?= $person->person_data()['minS'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Фосфор (P):</td>
                                        <td><?= $person->person_data()['minP'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Йод (I):</td>
                                        <td><?= $person->person_data()['minI'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Купрум (Cu):</td>
                                        <td><?= $person->person_data()['minCu'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Хром (Cr):</td>
                                        <td><?= $person->person_data()['minCr'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
<?php require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\Person;
use App\Models\Product; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Користувачі</title>
</head>

<body oncontextmenu="return false;">
    <?php //require_once 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="persons_page">
                <div class="anti-card grid grid-2">
                    <?php $persons = Person::all();
                    foreach ($persons as $person) { ?>
                        <div class="card card-person m-3 p-3" id="<?= $person->id ?>">
                            <h3><?= $person->name ?></h3>
                            <div class="face">
                                <span class="line">
                                    <p>Стать:</p>
                                    <p class="num"><?= $person->gender=="woman"?"жінка":"чоловік" ?></p>
                                </span>
                                <span class="line">
                                    <p>Вага:</p>
                                    <p class="num"><?= $person->weight ?> кг</p>
                                </span>
                                <span class="line">
                                    <p>Зріст:</p>
                                    <p class="num"><?= $person->height ?> см</p>
                                </span>
                                <span class="line">
                                    <p>Вік:</p>
                                    <p class="num"><?= $person->age() ?> р.</p>
                                </span>
                                <span class="line">
                                    <p>Дата народження:</p>
                                    <p class="num"><?php
                                    $date=$person->date_of_birth;

                                    $day=date("d",strtotime($date));
                                    $m=date("m",strtotime($date));
                                    $year=date("Y",strtotime($date));

                                    $month=Data::$months[$m*1-1];

                                    echo $day . " " . $month . " " .  $year;
                                    
                                    ?></p>
                                </span>
                                <span class="line">
                                    <p>Рівень активності:</p>
                                    <p class="num"><?= $person->activity ?></p>
                                </span>
                            </div>
                            <div class="addition">
                                <span class="line">
                                    <p>Ккалорії:</p>
                                    <p class="num"><?= $person->person_data['kcal'] ?> ккал</p>
                                </span>
                                <span class="line">
                                    <p>Білки:</p>
                                    <p class="num"><?= $person->person_data['protein'] ?> г</p>
                                </span>
                                <span class="line">
                                    <p>Вуглеводи:</p>
                                    <p class="num"><?= $person->person_data['carb'] ?> г</p>
                                </span>
                                <span class="line">
                                    <p>Жири:</p>
                                    <p class="num"><?= $person->person_data['fat'] ?> г</p>
                                </span>
                                <span class="line">
                                    <p>Вода:</p>
                                    <p class="num"><?= $person->person_data['water'] ?> мл</p>
                                </span>
                                <span class="line">
                                    <p>Клітковина:</p>
                                    <p class="num"><?= $person->person_data['cellulose'] ?> г</p>
                                </span>
                            </div>
                        </div>
                    <?php } ?>
                    <div onclick="location.href='../add/person.php'" class="add-card add-card-person m-3 p-3">
                        <h6>Додати особу</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="context-menu-open" id="contextmenuperson"></div>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>
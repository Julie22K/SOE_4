<?php require 'C:\Users\Dell\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\Person;
use App\Models\Product; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/head.php' ?>
    <title>Особи</title>
</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="persons_page">
                <div class="anti-card grid grid-2">
                    <?php $persons = Person::all();
                    foreach ($persons as $person) { ?>
                        <div class="card card-person m-3 p-3" id="<?= $person->id ?>">
                            <h3><?= $person->name ?></h3>
                            <div class="face">
                                <span class="line">
                                    <p>Стать:</p>
                                    <p class="num"><?= $person->gender ?></p>
                                </span>
                                <span class="line">
                                    <p>Вага:</p>
                                    <p class="num"><?= $person->weight ?>kg</p>
                                </span>
                                <span class="line">
                                    <p>Зріст:</p>
                                    <p class="num"><?= $person->height ?>cm</p>
                                </span>
                                <span class="line">
                                    <p>Вік:</p>
                                    <p class="num"><?= $person->age() ?>y.o.</p>
                                </span>
                                <span class="line">
                                    <p>Дата народження:</p>
                                    <p class="num"><?= $person->date_of_birth ?></p>
                                </span>
                                <span class="line">
                                    <p>Активність:</p>
                                    <p class="num"><?= $person->activity ?></p>
                                </span>
                            </div>
                            <div class="addition">
                                <span class="line">
                                    <p>Ккалорії:</p>
                                    <p class="num"><?= $person->person_data['kcal'] ?> kkal</p>
                                </span>
                                <span class="line">
                                    <p>Білки:</p>
                                    <p class="num"><?= $person->person_data['protein'] ?> g</p>
                                </span>
                                <span class="line">
                                    <p>Вуглуводи:</p>
                                    <p class="num"><?= $person->person_data['carb'] ?> g</p>
                                </span>
                                <span class="line">
                                    <p>Жири:</p>
                                    <p class="num"><?= $person->person_data['fat'] ?> g</p>
                                </span>
                                <span class="line">
                                    <p>Вода:</p>
                                    <p class="num"><?= $person->person_data['water'] ?> ml</p>
                                </span>
                                <span class="line">
                                    <p>Клітковина:</p>
                                    <p class="num"><?= $person->person_data['cellulose'] ?>g</p>
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
    <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/fotter.php'; ?>
</body>
<?php
require '../blocks/pre_head.php';
$page_title = "Члени родини";

use App\Data;
use App\Models\Person;

require '../blocks/head.php';
?>
<div class="page">

    <?php
    $persons = Person::where([["user_id",$_SESSION['user']['id']]]);
    if (count($persons) > 0) { ?>
        <div class="anti-card grid grid-2">
            <?php
            foreach ($persons as $person) { ?>
                <div class="card card-person m-3 p-3" id="<?= $person->id ?>">
                    <h3><?= $person->name ?></h3>
                    <div class="face">
                        <span class="line">
                            <p>Стать:</p>
                            <p class="num"><?= $person->gender == "woman" ? "жінка" : "чоловік" ?></p>
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
                                            $date = $person->date_of_birth;

                                            $day = date("d", strtotime($date));
                                            $m = date("m", strtotime($date));
                                            $year = date("Y", strtotime($date));

                                            $month = Data::$months[$m * 1 - 1];

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
                            <p class="num"><?= $person->kcal ?> ккал</p>
                        </span>
                        <span class="line">
                            <p>Білки:</p>
                            <p class="num"><?= $person->protein ?> г</p>
                        </span>
                        <span class="line">
                            <p>Вуглеводи:</p>
                            <p class="num"><?= $person->carb ?> г</p>
                        </span>
                        <span class="line">
                            <p>Жири:</p>
                            <p class="num"><?= $person->fat ?> г</p>
                        </span>
                        <span class="line">
                            <p>Вода:</p>
                            <p class="num"><?= $person->water ?> мл</p>
                        </span>
                        <span class="line">
                            <p>Клітковина:</p>
                            <p class="num"><?= $person->cellulose ?> г</p>
                        </span>
                    </div>
                </div>
            <?php } ?>
            <div onclick="location.href='../add/person.php'" class="add-card add-card-person m-3 p-3">
                <h6>Додати особу</h6>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="empty-page">
            <img src="../../assets/images/empty.png" alt="empty.png">
            <p>Даних не знайдено</p>
        </div>
    <?php
    }
    ?>
</div>

<?php require '../blocks/fotter.php'; ?>
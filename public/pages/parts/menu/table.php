<?php
$style_grid = '';
for ($i = 0; $i < $menu->days_interval + 2; $i++) {
    $style_grid = $style_grid . " auto";
}
?>
<div class="anti-card grid m-3 w-full" id="menu" style="grid-template-columns: <?= $style_grid ?>;">
    <div class="card card-daytime">
        <h6 class="text-center"><?= $menu->first_date ?> - <br/><?= $menu->last_date ?></h6>
    </div>
    <?php

    use App\Models\MealTime;
    use App\Models\Menu;

    foreach ($menu->dates() as $day) {
    ?>
        <div class="card card-day">
            <h6 class="text-center"><?= $day ?></h6>
        </div>
    <?php
    }
    $meal_times = MealTime::all();

    foreach ($meal_times as $time) {
    ?>
        <div class="card card-time">
            <h6 class="text-center"><?= $time->name ?></h6>
        </div>
        <?php
        foreach ($menu->dates() as $dayweek) {
            $dish_id = 0;
            $res = array();

            foreach ($menu->dishes() as $dish) {
                if ($dish->meal_time_id === $time->id && $dish->date === $dayweek) {

                    array_push($res, $dish->recipe()->title);
                    $dish_id = $dish->id;
                }
            }

            $text = join(', ',$res);
            
            if ($text == "") {
        ?>
                <div class="add-card add-card-dish invisible" id="<?= $dish_id ?>" onclick="location.href='../add/dish.php?menu=<?= $menu->id ?>&date=<?= $dayweek ?>&time=<?= $time->id ?>'">
                    <h6>Додати</h6>
                </div>
            <?php
            } else {
            ?>
                <div class="card card-dish" day="<?= $dayweek ?>" menu="<?= $menu->id ?>" time="<?= $time->id ?>" id="<?= $dish_id ?>">
                    <ul class="text-center" style="padding:5px;"><li><?= $text ?></li></ul>

                </div>
    <?php
            }
        }
    }

    ?>
    <?php

    ?>
</div>
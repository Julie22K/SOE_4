<div class="anti-card m-3" id="finance">
    <?php

    use App\Models\Menu;

    $all_shop_items_exists_counter = 0;
    $shop_items_all = $menu->shop_items();
    $all_shop_items_exists = count($shop_items_all) != 0 ? ($all_shop_items_exists_counter * 100) / count($shop_items_all) : 0;

    $budget = 0;
    $need = 0;
    $used =  0;
    $need_val = 0;
    $used_val =  0;
    $style = '';
    $used_val2 =  0;
    if (count($shop_items_all) != 0) {
        foreach ($shop_items_all as $shop_item) {
            //var_dump($shop_item);
            if ($shop_item->is_exists) $all_shop_items_exists_counter++;
        }
        //var_dump($menu->statistic_budget());
        $budget = $menu->budget;
        $need =  round($menu->budget_need());
        $used =  round($menu->budget_used());
        $need_val =  round($menu->statistic_budget()['need']);
        $used_val =  round($menu->statistic_budget()['used']);
        $used_val2 = $need_val != 0 ? round(($used_val * 100) / $need_val) : 0;


        if ($all_shop_items_exists >= 80 && $all_shop_items_exists <= 100) $style = "success";
        else if ($need_val > 100) $style = 'warning';
    }
    ?>
    <div class="progress" title="Бюджет: <?= $budget ?> грн">
        <div class="progress-need <?= $style ?>" style="width:<?= $need_val ?>%;<?=$need_val<=45?'color:gray;':''?>" title="Необхідна сума: <?= $need ?> грн<?= $need_val>=100?" / Бюджет:" . $budget . " грн":""?>">
            <span class="text-center"><?= $need_val . '%' ?></span>

            <div class="progress-used" style="position:relative;width:<?= $used_val2 ?>%;" title="Товарів закуплено на суму: <?= $used ?> грн">
                <span class="text-center" style=""><?= $used_val2!=0?$used_val2 . '%':''?> </span>
            </div>
        </div>

    </div>

</div>
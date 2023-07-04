<div class="anti-card" id="shopping_list">
    <form action="../../../../vendor/shop_item/check.php?id=<?= $menu->id ?>" method="post">
        <?php

        use App\Models\Menu;
        use App\Models\ProductCategory;

        $shop_items = $menu->shop_items();

        //var_dump($shop_items);

        $shoplist = array();

        foreach (ProductCategory::all() as $category) {
            $shoplist[$category->id] = array();
            //array_push($shoplist, array());
        }
        foreach ($shop_items as $shop_item) {
            //var_dump($shop_items);

            foreach (ProductCategory::all() as $category) {

                if ($shop_item->product()->category_id == $category->id) array_push($shoplist[$category->id], $shop_item);
            }
        }

        foreach ($shoplist as $key => $sublist) {


            $category_id = $key;

            if (count($sublist) != 0) {

                $category_name = $sublist[0]->product()->category()->name;
                echo '<table id="table_' . $category_id . '"><caption onclick="ToggleSubList(\'table_' . $category_id . '\')"><h3><span><img class="product-icon" src="../../assets/images/product_categories/' . $category_name . '.png" alt="' . $category_name . '"></span>' . $category_name . '</h3></caption>';
            } else echo '<table id="table_' . $category_id . '" class="none-element">';
            foreach ($sublist as $shop_item) {

        ?>
                <tr id="shop_item_<?= $shop_item->id ?>">

                    <td class="check"><input type="checkbox" name="shop_items_checked[]" value="<?= $shop_item->id ?>" <?= $shop_item->is_exists ? 'checked' : '' ?>>

                    </td>
                    <td class="name"><?= $shop_item->product()->title ?></td>
                    <td class="dish"><input type="number" class="none-element" value="<?= $shop_item->id ?>" name="shop_items[]">
                    </td>
                    <td class="weight"><?= $shop_item->ingredient()->weight ?> г</td>
                    <td class="price"><?= $shop_item->ingredient()->price() ?> грн</td>
                </tr>
        <?php
            }
            echo '</table>';
        }
        ?>
        <!-- <p style="cursor: pointer;" onclick="location.href='Addshoplist.php'">+Add</p> -->
        <div class="row-reverse"><button type="submit" class="btn btn-cancel">Зберегти</button></div>
    </form>
</div>
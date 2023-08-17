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
                echo '<table id="table_' . $category_id . '"><caption onclick="$(\'#tbody_' . $category_id . '\').fadeToggle(\'slow\')"><h3><span><img class="product-icon" src="../../assets/images/product_categories/' . $category_name . '.png" alt="' . $category_name . '"></span>' . $category_name . '</h3></caption><thead></thead><tbody id="tbody_' . $category_id . '">';
            } else echo '<table id="table_' . $category_id . '" class="none-element">';

            $sublist_res=array();
            foreach($sublist as $shop_item) {
                $newitem=[
                    'ids'=>$shop_item->id,
                    'title'=>$shop_item->product()->title,
                    'product_id'=>$shop_item->product_id,
                    'is_exists'=>$shop_item->is_exists,
                    'weight'=>$shop_item->ingredient()->weight,
                    'price'=>$shop_item->ingredient()->price(),
                    'dishes'=>array($shop_item->dish()->recipe()->title),
                ];

                $not_exists=true;
                
                foreach($sublist_res as &$sr){
                    if($sr["product_id"]===$newitem["product_id"]){
                        $sr["ids"]=$newitem["ids"] . "_" . $sr["ids"];
                        $sr["weight"]=$sr["weight"]+$newitem["weight"];
                        $sr["price"]=$sr["price"]+$newitem["price"];
                        if(!in_array($newitem["dishes"],$sr["dishes"])) array_push($sr["dishes"],$newitem["dishes"]);
                        
                        $not_exists=false;
                        break;
                    }
                    
                }
                if($not_exists) array_push($sublist_res, $newitem);
            }
            foreach ($sublist_res as &$shop_item) {
                $new_dishes=array();
                foreach($shop_item['dishes'] as $sd){
                    if($sd!="Array") array_push($new_dishes,$sd);
                }
                $shop_item['dishes']=$sd;
        ?>
                <tr id="shop_item_<?= $shop_item['ids']  ?>">
                    <td class="check"><input type="checkbox" name="shop_items_checked[]" value="<?= $shop_item['ids']  ?>" <?= $shop_item['is_exists'] ? 'checked' : '' ?>></td>
                    <td class="name"><?= $shop_item['title'] ?></td>
                    <td class="dish"><?= join(',',$shop_item['dishes']) ?><input type="number" class="none-element" value="<?= $shop_item['ids'] ?>" name="shop_items[]"></td>
                    <td class="weight"><?= $shop_item['weight'] ?> г</td>
                    <td class="price"><?= $shop_item['price'] ?> грн</td>
                </tr>
        <?php
            }
            echo '</tbody></table>';
        }
        ?>
        <!-- <p style="cursor: pointer;" onclick="location.href='Addshoplist.php'">+Add</p> -->
        <div class="row-reverse"><button type="submit" class="btn btn-cancel">Зберегти</button></div>
    </form>
</div>
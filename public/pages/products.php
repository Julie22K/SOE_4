<?php require 'C:\Users\Dell\source\SOE_4\public\blocks/pre_head.php'; ?>
<!doctypehtml>
    <html lang="en">

    <head>
        <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/head.php' ?>
        <title>Продукти</title>
    </head>

    <body oncontextmenu="return false;">
        <script></script>
        <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/preloader.php' ?>
        <div class="container"><?php require 'C:\Users\Dell\source\SOE_4\public\blocks/header.php' ?>
            <div class="main"><?php require 'C:\Users\Dell\source\SOE_4\public\blocks/topbar.php' ?>
                <div class="page" id="product_page">
                    <div class="m-3 w-full anti-card j-c-be row">
                        <div class="row"><button class="btn m-3 btn-cancel" onclick='location.href="shops.php"'>Магазини</button>
                            <button class="btn m-3 btn-cancel" onclick='location.href="manufacturers.php"'>Виробники</button>
                        </div>
                        <div class="row"><button class="btn m-3 btn-important btn-small" onclick='location.href="../add/product.php"'>Додати продукт</button></div>
                    </div>
                    <div class="m-3 w-full p-3 card-header col" id="filter-sort">
                        <div class="border-line-bottom p-b-2" id="filter">
                            <h3>Фільтрувати за:</h3>
                            <div class="row row-wrap"><button class="btn m-2 p-2 btn-filter-sort active productSort" onclick='filterSelection("all")'>Всі</button>
                                <?php $types = App\Models\ProductCategory::all();
                                foreach ($types as $type) { ?>
                                    <button class="btn m-2 p-2 btn-filter-sort productSort" onclick='filterSelection("category_<?= $type->id ?>")'><?= $type->name ?></button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="border-line-bottom p-b-2 m-t-2" id="sort">
                            <h3>Сортувати за:</h3>
                            <div class="row row-wrap sort"><button class="btn m-2 p-2 btn-filter-sort sort-products active" onclick='sort_products("name_of_product","#sortProductByName","name")' id="sortProductByName">A..Z</button>
                                <button class="btn m-2 p-2 btn-filter-sort sort-products" onclick='sort_products("price_of_product","#sortProductByPrice","price")' id="sortProductByPrice">Price</button>
                                <button class="btn m-2 p-2 btn-filter-sort sort-products" onclick='sort_products("kcal_of_product","#sortProductByKCAL","kcal")' id="sortProductByKCAL">Kcal</button>
                                <button class="btn m-2 p-2 btn-filter-sort sort-products" onclick='sort_products("carb_of_product","#sortProductByCarb","carb")' id="sortProductByCarb">Carbonation</button>
                                <button class="btn m-2 p-2 btn-filter-sort sort-products" onclick='sort_products("fat_of_product","#sortProductByFat","fat")' id="sortProductByFat">fat</button>
                                <button class="btn m-2 p-2 btn-filter-sort sort-products" onclick='sort_products("protein_of_product","#sortProductByProtein","protein")' id="sortProductByProtein">protein</button>
                                <button class="btn m-2 p-2 btn-filter-sort sort-products" onclick='sort_products("water_of_product","#sortProductByWater","water")' id="sortProductByWater">water</button>
                                <button class="btn m-2 p-2 btn-filter-sort sort-products" onclick='sort_products("cellulose_of_product","#sortProductByCellulose","cellulose")' id="sortProductByCellulose">cellulose</button>
                                <div class="dropdown dropdown-vit"><button class="btn m-2 p-2 btn-filter-sort" onclick='show_hide("list_items_vit")'>Vitamins</button>
                                    <div class="list-items-for-sort" id="list_items_vit"><button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitA_of_product","#sortProductByVitA","A")' id="sortProductByVitA">vit A</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitE_of_product","#sortProductByVitE","E")' id="sortProductByVitE">vit E</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitK_of_product","#sortProductByVitK","K")' id="sortProductByVitK">vit K</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitD_of_product","#sortProductByVitD","D")' id="sortProductByVitD">vit D</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitC_of_product","#sortProductByVitC","C")' id="sortProductByVitC">vit C</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("om3_of_product","#sortProductByOm3","Om3")' id="sortProductByOm3">omega-3</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("om6_of_product","#sortProductByVitOm6","Om6")' id="sortProductByVitOm6">imega-6</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitB1_of_product","#sortProductByVitB1","B1")' id="sortProductByVitB1">vit B1</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitB2_of_product","#sortProductByVitB2","B2")' id="sortProductByVitB2">vit B2</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitB5_of_product","#sortProductByVitB5","B5")' id="sortProductByVitB5">vit B5</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitB6_of_product","#sortProductByVitB6","B6")' id="sortProductByVitB6">vit B6</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitB8_of_product","#sortProductByVitB8","B8")' id="sortProductByVitB8">vit B8</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitB9_of_product","#sortProductByVitB9","B9")' id="sortProductByVitB9">vit B9</button>
                                        <button class="btn m-2 p-2 sort-products-vit" onclick='sort_products("vitB12_of_product","#sortProductByVitB12","B12")' id="sortProductByVitB12">vit B12</button>
                                    </div>
                                </div>
                                <div class="dropdown dropdown-min"><button class="btn m-2 p-2 btn-filter-sort" onclick='show_hide("list_items_min")'>Minerals</button>
                                    <div class="list-items-for-sort" id="list_items_min"><button class="btn m-2 p-2 sort-products-min" onclick='sort_products("mg_of_product","#sortProductByMinMg","Mg")' id="sortProductByMinMg">min Mg</button>
                                        <button class="btn m-2 p-2 sort-products-min" onclick='sort_products("na_of_product","#sortProductByMinNa","Na")' id="sortProductByMinNa">min Na</button>
                                        <button class="btn m-2 p-2 sort-products-min" onclick='sort_products("cl_of_product","#sortProductByMinCl","Cl")' id="sortProductByMinCl">min Cl</button>
                                        <button class="btn m-2 p-2 sort-products-min" onclick='sort_products("ca_of_product","#sortProductByMinCa","Ca")' id="sortProductByMinCa">min Ca</button>
                                        <button class="btn m-2 p-2 sort-products-min" onclick='sort_products("k_of_product","#sortProductByMinK","K")' id="sortProductByMinK">min K</button>
                                        <button class="btn m-2 p-2 sort-products-min" onclick='sort_products("s_of_product","#sortProductByMinS","S")' id="sortProductByMinS">min S</button>
                                        <button class="btn m-2 p-2 sort-products-min" onclick='sort_products("p_of_product","#sortProductByMinP","P")' id="sortProductByMinP">min P</button>
                                        <button class="btn m-2 p-2 sort-products-min" onclick='sort_products("cu_of_product","#sortProductByMinCu","Cu")' id="sortProductByMinCu">min Cu</button>
                                        <button class="btn m-2 p-2 sort-products-min" onclick='sort_products("i_of_product","#sortProductByMinI","I")' id="sortProductByMinI">min I</button>
                                        <button class="btn m-2 p-2 sort-products-min" onclick='sort_products("cr_of_product","#sortProductByMinCr","Cr")' id="sortProductByMinCr">min Cr</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="search" id="search_form">
                            <h3>Знайти продукт: <label><span class="row"><input class="m-2 p-2" disabled type="search" id="srch" name="searchField" placeholder="Почніть вводити значення">
                                        <input class="btn m-2 p-2 btn-search" disabled type="submit" onclick="show()" value="Знайти"></span>
                        </form>
                    </div>
                    <div class="m-3 w-full p-3 card">
                        <table>
                            <thead>
                                <tr>
                                    <th>Назва</th>
                                    <th>Категорія</th>
                                    <th>Середня ціна (на 100 г)</th>
                                    <th>Ккалорії</th>
                                    <th>Білки</th>
                                    <th>Вуглеводи</th>
                                    <th>Жири</th>
                                    <th id="h_cellulose">Клітковина</th>
                                    <th id="h_water">Вода</th>
                                    <?php $vits_mins = array("A", "E", "K", "D", "C", "Om3", "Om6", "B1", "B2", "B5", "B6", "B8", "B9", "B12", "Mg", "Na", "Cl", "Ca", "K", "S", "P", "Cu", "I", "Cr");
                                    foreach ($vits_mins as $vit_or_min) { ?><th id="h_<?= $vit_or_min ?>" style="display:none"><?= $vit_or_min ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php
                                $products = App\Models\Product::all();
                                foreach ($products as $product) {
                                ?>
                                    <tr class="tr-product category_<?= $product->category_id ?>" id="<?= $product->id ?>" name_of_product="<?= $product->title ?>" price_of_product="<?= $product->avg_price() ?>" <?php foreach (App\Data::$info_data as $item) { ?> <?= $item ?> <?php } ?>>
                                        <td class="name">
                                            <?= $product->title ?>
                                        </td>
                                        <td><img alt="<?= $product->category()->name ?>" class="product-icon" src="../../assets/images/product_categories/<?= $product->category()->name ?>.png"></td>
                                        <td><?= $product->avg_price() == 0 ? ' - ' : $product->avg_price() . " грн" ?></td>
                                        <?php
                                        $is_hide = "";
                                        foreach (App\Data::$info_data as $item) {
                                            if ($item == "cellulose") $is_hide = 'style="display:none"'; ?>
                                            <td <?= $is_hide ?>><?= $product->product_data[$item] ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="context-menu-open" id="contextmenuproducttr"></div>
        <?php require 'C:\Users\Dell\source\SOE_4\public\blocks/fotter.php'; ?>
        <script src="../../assets/js/pagination.js"></script>
        <script src="../../assets/js/filter/products.js"></script>
        <script src="../../assets/js/sort/sort_products.js"></script>
    </body>

    </html>
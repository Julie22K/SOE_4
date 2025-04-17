<?php

use App\Models\Product;

require '../blocks/pre_head.php';
$page_title = "Продукти";

$page = 0;
$sort_value = 'id';
$filter_value = null;
$search_value = null;
if (isset($_GET['page'])) $page = $_GET['page'];
if (isset($_GET['filter'])) $filter_value = $_GET['filter'];
if (isset($_GET['sort'])) $sort_value = $_GET['sort'];
if (isset($_GET['searchField'])) $search_value = $_GET['searchField'];

function check_sort_active(string $sort_value,string $val):void
{
    echo $val==$sort_value?'active':'';
}

require '../blocks/head.php';
?>
<div class="page">
    <div class="m-3 w-full anti-card j-c-be row">
        <div class="row"><button class="btn m-3 btn-cancel" onclick='location.href="shops.php"'>Магазини</button>
            <button class="btn m-3 btn-cancel" onclick='location.href="manufacturers.php"'>Виробники</button>
        </div>
        <div class="row"><button class="btn m-3 btn-important btn-small" onclick='location.href="../add/product.php"'>Додати продукт</button></div>
    </div>
    <div class="m-3 w-full p-3 card-header col" id="filter-sort">
        <div class="border-line-bottom p-b-2" id="filter">
            <h3>Фільтрувати за:</h3>
            <div class="row row-wrap"><button class="btn m-2 p-2 btn-filter-sort <?= $filter_value == null ? "active" : "" ?> productSort" onclick='Filter(null)'>Всі</button>
                <?php $types = App\Models\ProductCategory::all();
                foreach ($types as $type) { ?>
                    <button class="btn m-2 p-2 btn-filter-sort productSort <?= $filter_value == $type->id ? "active" : "" ?>" onclick="Filter(<?= $type->id ?>)"><?= $type->name ?></button>
                <?php } ?>
            </div>
        </div>
        <div class="border-line-bottom p-b-2 m-t-2" id="sort">
            <h3>Сортувати за:</h3>
            <div class="row row-wrap sort"><button class="btn m-2 p-2 btn-filter-sort sort-products <?= check_sort_active($sort_value,'id') ?>" onclick='Sort("title")' id="sortProductByName">A..Z</button>
                <!-- <button class="btn m-2 p-2 btn-filter-sort sort-products" onclick='Sort("price")' id="sortProductByPrice">Price</button> -->
                <button class="btn m-2 p-2 btn-filter-sort sort-products <?= check_sort_active($sort_value,'kcal') ?>" onclick='Sort("kcal")' id="sortProductByKCAL">Kcal</button>
                <button class="btn m-2 p-2 btn-filter-sort sort-products <?= check_sort_active($sort_value,'carb') ?>" onclick='Sort("carb")' id="sortProductByCarb">Carbonation</button>
                <button class="btn m-2 p-2 btn-filter-sort sort-products <?= check_sort_active($sort_value,'fat') ?>" onclick='Sort("fat")' id="sortProductByFat">fat</button>
                <button class="btn m-2 p-2 btn-filter-sort sort-products <?= check_sort_active($sort_value,'protein') ?>" onclick='Sort("protein")' id="sortProductByProtein">protein</button>
                <button class="btn m-2 p-2 btn-filter-sort sort-products <?= check_sort_active($sort_value,'water') ?>" onclick='Sort("water")' id="sortProductByWater">water</button>
                <button class="btn m-2 p-2 btn-filter-sort sort-products <?= check_sort_active($sort_value,'cellulose') ?>" onclick='Sort("cellulose")' id="sortProductByCellulose">cellulose</button>
                <div class="dropdown dropdown-vit">
                    <button class="btn m-2 p-2 btn-filter-sort" onclick='OpenDropDown("list_items_vit")'>Vitamins</button>
                    <div class="list-items-for-sort" id="list_items_vit">
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitA') ?>" onclick='Sort("vitA")' id="sortProductByVitA">vit A</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitE') ?>" onclick='Sort("vitE")' id="sortProductByVitE">vit E</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitK') ?>" onclick='Sort("vitK")' id="sortProductByVitK">vit K</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitD') ?>" onclick='Sort("vitD")' id="sortProductByVitD">vit D</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitC') ?>" onclick='Sort("vitC")' id="sortProductByVitC">vit C</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'om3') ?>" onclick='Sort("om3")' id="sortProductByOm3">omega-3</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'om6') ?>" onclick='Sort("om6")' id="sortProductByVitOm6">imega-6</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitB1') ?>" onclick='Sort("vitB1")' id="sortProductByVitB1">vit B1</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitB2') ?>" onclick='Sort("vitB2")' id="sortProductByVitB2">vit B2</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitB5') ?>" onclick='Sort("vitB5")' id="sortProductByVitB5">vit B5</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitB6') ?>" onclick='Sort("vitB6")' id="sortProductByVitB6">vit B6</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitB8') ?>" onclick='Sort("vitB8")' id="sortProductByVitB8">vit B8</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitB9') ?>" onclick='Sort("vitB9")' id="sortProductByVitB9">vit B9</button>
                        <button class="btn m-2 p-2 sort-products-vit <?= check_sort_active($sort_value,'vitB12') ?>" onclick='Sort("vitB12")' id="sortProductByVitB12">vit B12</button>
                    </div>
                </div>
                <div class="dropdown dropdown-min"><button class="btn m-2 p-2 btn-filter-sort" onclick='OpenDropDown("list_items_min")'>Minerals</button>
                    <div class="list-items-for-sort" id="list_items_min">
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minMg') ?>" onclick='Sort("minMg")' id="sortProductByMinMg">min Mg</button>
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minNa') ?>" onclick='Sort("minNa")' id="sortProductByMinNa">min Na</button>
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minCl') ?>" onclick='Sort("minCl")' id="sortProductByMinCl">min Cl</button>
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minCa') ?>" onclick='Sort("minCa")' id="sortProductByMinCa">min Ca</button>
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minK') ?>" onclick='Sort("minK")' id="sortProductByMinK">min K</button>
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minS') ?>" onclick='Sort("minS")' id="sortProductByMinS">min S</button>
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minP') ?>" onclick='Sort("minP")' id="sortProductByMinP">min P</button>
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minCu') ?>" onclick='Sort("minCu")' id="sortProductByMinCu">min Cu</button>
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minI') ?>" onclick='Sort("minI")' id="sortProductByMinI">min I</button>
                        <button class="btn m-2 p-2 sort-products-min <?= check_sort_active($sort_value,'minCr') ?>" onclick='Sort("minCr")' id="sortProductByMinCr">min Cr</button>
                    </div>
                </div>
            </div>
        </div>
        <form class="search " id="search_form">
            <h3 class="">Знайти продукт:</h3>
            <span class="row"><input class="m-2 p-2" type="search" id="srch" name="searchField" placeholder="Введіть назву">
                <input class="btn m-2 p-2 btn-search" type="submit" onclick="Search(document.getElementById('srch').value)" value="Знайти"></span>
        </form>
    </div>
    <?php
    $page_size = 10;
    $page_offset = (($page == 0 ? 1 : $page) - 1) * $page_size;

    $where_for_filter = $filter_value != null ? "product_category_id=$filter_value" : "";
    if ($search_value != null) $where_for_filter . " AND ";
    $where_for_search = $search_value != null ? "title LIKE '$search_value%'" : "";
    $where = $where_for_filter . $where_for_search;

    //for user
    $user_id = $_SESSION['user']['id'];
    if ($where != "") $where .= " AND ";
    $where .= "(is_private=false OR (is_private=true AND user_id=$user_id))";
    $count = Product::count($where);
    $last_page = round($count / $page_size);

    $products = [];
    if ($count < $page_size) $products = Product::WhereAndOrderByWithPagination($where, $sort_value . " ASC ", $page_size);
    else $products = Product::WhereAndOrderByWithPagination($where, $sort_value . " DESC ", $page_size, $page_offset);

    if (count($products) != 0) {

    ?>
        <div class="m-3 w-full p-3 card">
            <table>
                <?php
                $is_hide = 'style="display:none"';
                ?>
                <thead>
                    <tr>
                        <th>Назва</th>
                        <th>Категорія</th>
                        <th>Середня ціна (на 100 г)</th>
                        <th>Ккалорії</th>
                        <th>Жири</th>
                        <th>Вуглеводи</th>
                        <th>Білки</th>
                        <th <?= $sort_value == "cellulose" ? "" : $is_hide ?>>Клітковина</th>
                        <th <?= $sort_value == "water" ? "" : $is_hide ?>>Вода</th>
                        <?php $vits_mins = array("vitA", "vitE", "vitK", "vitD", "vitC", "om3", "om6", "vitB1", "vitB2", "vitB5", "vitB6", "vitB8", "vitB9", "vitB12", "minMg", "minNa", "minCl", "minCa", "minK", "minS", "minP", "minCu", "minI", "minCr");
                        foreach ($vits_mins as $vit_or_min) { ?>
                            <th <?= $sort_value == $vit_or_min ? "" : $is_hide ?>><?= $vit_or_min ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php
                    foreach ($products as $product) {
                    ?>
                        <tr class="tr-product" id="<?= $product->id ?>">
                            <td class="name row">
                                <?= $product->title ?>
                            </td>
                            <td><img alt="<?= $product->category()->name ?>" title="Категорія: <?= $product->category()->name ?>" class="product-icon" src="../../assets/images/product_categories/<?= $product->category()->name ?>.png"></td>
                            <td><?= $product->avg_price() == 0 ? ' - ' : $product->avg_price() . " грн" ?></td>
                            <?php
                            $is_hide = '';
                            foreach (App\Data::$info_data as $item) { ?>
                                <td <?= $sort_value == $item ? "" : $is_hide ?>><?= $product->$item == 0 ? " - " : $product->$item ?></td>


                            <?php
                                if ($item == "protein") $is_hide = 'style="display:none"';
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>

        <div class="page_navigation row">
            <button onmouseover="BeforeChangePage(this,true)" onmouseleave="BeforeChangePage(this,false)" class="previous_link" onclick="ChangePage(0)"><<</button>
                    <button onmouseover="BeforeChangePage(this,true)" onmouseleave="BeforeChangePage(this,false)" <?= ($page - 2) < 1 ? "style='display:none'" : "" ?> onclick="ChangePage(<?= $page - 2 ?>)"><?= $page - 2 + 1 ?></button>
                    <button onmouseover="BeforeChangePage(this,true)" onmouseleave="BeforeChangePage(this,false)" <?= ($page - 1) < 1 ? "style='display:none'" : "" ?> onclick="ChangePage(<?= $page - 1 ?>)"><?= $page - 1 + 1 ?></button>
                    <button id="pagination_current_page" class="current_page" onclick="ChangePage(<?= $page ?>)"><?= $page + 1 ?></button>
                    <button onmouseover="BeforeChangePage(this,true)" onmouseleave="BeforeChangePage(this,false)" <?= ($page + 1) > $last_page ? "style='display:none'" : "" ?> onclick="ChangePage(<?= $page + 1 ?>)"><?= $page + 1 + 1 ?></button>
                    <button onmouseover="BeforeChangePage(this,true)" onmouseleave="BeforeChangePage(this,false)" <?= ($page + 2) > $last_page ? "style='display:none'" : "" ?> onclick="ChangePage(<?= $page + 2 ?>)"><?= $page + 2 + 1 ?></button>
                    <button onmouseover="BeforeChangePage(this,true)" onmouseleave="BeforeChangePage(this,false)" class="next_link" onclick="ChangePage(<?= $last_page ?>)">>></button>
        </div>
    <?php
    } else {
    ?>
        <div class="empty-page">
            <img src="../../assets/images/empty.png" alt="empty.png">
            <p>Продуктів не знайдено</p>
        </div>
    <?php
    }
    ?>
</div>
</div>
</div>
<?php require '../blocks/fotter.php'; ?>
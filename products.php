<?php
require_once 'config/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'blocks/head.php' ?>
    <title>Products</title>
</head>
<body>
    <?php require_once 'blocks/preloader.php' ?>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <div class="container">
        <?php require_once 'blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php' ?>
            <div class="page" id="product_page">
                <div class="row-reverse anti-card m-0">
                    <button class="btn btn-important" onclick="location.href='Addproduct.php'">Add product</button>
                </div>
                <div class="card-header col" id="filter-sort">
                    <div id="filter" class="border-line-bottom p-b-2">
                        <h3>Filter by:</h3>
                        <div class="row row-wrap">
                            <button onclick="filterSelection('all')" class="btn btn-filter-sort productSort active">All</button>
                            <?php
                            foreach ($types as $type) {
                                ?>
                                <button onclick="filterSelection('<?= $type ?>')" class="btn btn-filter-sort productSort"><?= $type ?></button>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div id="sort" class="border-line-bottom p-b-2 m-t-2">
                        <h3>Sort by:</h3>
                        <div class="sort row row-wrap">
                            <button onclick="sort_products('name_of_product','#sortProductByName','name')" id="sortProductByName" class="btn btn-filter-sort active sort-products">A..Z</button>
                            <button onclick="sort_products('price_of_product','#sortProductByPrice','price')" id="sortProductByPrice" class="btn btn-filter-sort sort-products">Price</button>
                            <button onclick="sort_products('kcal_of_product','#sortProductByKCAL','kcal')" id="sortProductByKCAL" class="btn btn-filter-sort sort-products">Kcal</button>
                            <button onclick="sort_products('carb_of_product','#sortProductByCarb','carb')" id="sortProductByCarb" class="btn btn-filter-sort sort-products">Carbonation</button>
                            <button onclick="sort_products('fat_of_product','#sortProductByFat','fat')" id="sortProductByFat" class="btn btn-filter-sort sort-products">fat</button>
                            <button onclick="sort_products('protein_of_product','#sortProductByProtein','protein')" id="sortProductByProtein" class="btn btn-filter-sort sort-products">protein</button>
                            <button onclick="sort_products('water_of_product','#sortProductByWater','water')" id="sortProductByWater" class="btn btn-filter-sort sort-products">water</button>
                            <button onclick="sort_products('cellulose_of_product','#sortProductByCellulose','cellulose')" id="sortProductByCellulose" class="btn btn-filter-sort sort-products">cellulose</button>

                            <div class="dropdown dropdown-vit">
                                <button onclick="show_hide('list_items_vit')" class="btn btn-filter-sort">Vitamins</button>
                                <div id="list_items_vit" class="list-items-for-sort">

                                    <button onclick="sort_products('vitA_of_product','#sortProductByVitA','A')" id="sortProductByVitA" class="btn sort-products-vit">vit A</button>
                                    <button onclick="sort_products('vitE_of_product','#sortProductByVitE','E')" id="sortProductByVitE" class="btn sort-products-vit">vit E</button>
                                    <button onclick="sort_products('vitK_of_product','#sortProductByVitK','K')" id="sortProductByVitK" class="btn sort-products-vit">vit K</button>
                                    <button onclick="sort_products('vitD_of_product','#sortProductByVitD','D')" id="sortProductByVitD" class="btn sort-products-vit">vit D</button>
                                    <button onclick="sort_products('vitC_of_product','#sortProductByVitC','C')" id="sortProductByVitC" class="btn sort-products-vit">vit C</button>
                                    <button onclick="sort_products('om3_of_product','#sortProductByOm3','Om3')" id="sortProductByOm3" class="btn sort-products-vit">omega-3</button>
                                    <button onclick="sort_products('om6_of_product','#sortProductByVitOm6','Om6')" id="sortProductByVitOm6" class="btn  sort-products-vit">imega-6</button>
                                    <button onclick="sort_products('vitB1_of_product','#sortProductByVitB1','B1')" id="sortProductByVitB1" class="btn sort-products-vit">vit B1</button>
                                    <button onclick="sort_products('vitB2_of_product','#sortProductByVitB2','B2')" id="sortProductByVitB2" class="btn sort-products-vit">vit B2</button>
                                    <button onclick="sort_products('vitB5_of_product','#sortProductByVitB5','B5')" id="sortProductByVitB5" class="btn sort-products-vit">vit B5</button>
                                    <button onclick="sort_products('vitB6_of_product','#sortProductByVitB6','B6')" id="sortProductByVitB6" class="btn sort-products-vit">vit B6</button>
                                    <button onclick="sort_products('vitB8_of_product','#sortProductByVitB8','B8')" id="sortProductByVitB8" class="btn sort-products-vit">vit B8</button>
                                    <button onclick="sort_products('vitB9_of_product','#sortProductByVitB9','B9')" id="sortProductByVitB9" class="btn sort-products-vit">vit B9</button>
                                    <button onclick="sort_products('vitB12_of_product','#sortProductByVitB12','B12')" id="sortProductByVitB12" class="btn sort-products-vit">vit B12</button>
                                </div>
                            </div>
                            <div class="dropdown dropdown-min">
                                <button onclick="show_hide('list_items_min')" class="btn btn-filter-sort">Minerals</button>
                                <div id="list_items_min" class="list-items-for-sort">
                                    <button onclick="sort_products('mg_of_product','#sortProductByMinMg','Mg')" id="sortProductByMinMg" class="btn  sort-products-min">min Mg</button>
                                    <button onclick="sort_products('na_of_product','#sortProductByMinNa','Na')" id="sortProductByMinNa" class="btn  ive sort-products-min">min Na</button>
                                    <button onclick="sort_products('cl_of_product','#sortProductByMinCl','Cl')" id="sortProductByMinCl" class="btn  sort-products-min">min Cl</button>
                                    <button onclick="sort_products('ca_of_product','#sortProductByMinCa','Ca')" id="sortProductByMinCa" class="btn  sort-products-min">min Ca</button>
                                    <button onclick="sort_products('k_of_product','#sortProductByMinK','K')" id="sortProductByMinK" class="btn  sort-products-min">min K</button>
                                    <button onclick="sort_products('s_of_product','#sortProductByMinS','S')" id="sortProductByMinS" class="btn  sort-products-min">min S</button>
                                    <button onclick="sort_products('p_of_product','#sortProductByMinP','P')" id="sortProductByMinP" class="btn  sort-products-min">min P</button>
                                    <button onclick="sort_products('cu_of_product','#sortProductByMinCu','Cu')" id="sortProductByMinCu" class="btn  sort-products-min">min Cu</button>
                                    <button onclick="sort_products('i_of_product','#sortProductByMinI','I')" id="sortProductByMinI" class="btn sort-products-min">min I</button>
                                    <button onclick="sort_products('cr_of_product','#sortProductByMinCr','Cr')" id="sortProductByMinCr" class="btn sort-products-min">min Cr</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="search" id="search_form">
                        <h3>Search: <label>
                                    <span class="row">
                                        <input type="search" id="srch" placeholder="search..." name="searchField" disabled>

                                    <input type="submit" class="btn btn-search" value="Search" onclick="show()" disabled>
                                    </span>

                    </form>
                </div>
                <div class="card" id="products_table">
                    <table>
                        <colgroup>
                            <col span="1" style="width: 17%;">
                            <col span="1" style="width: 8%;">
                            <col span="1" style="width: 12.5%;">
                            <col span="1" style="width: 12.5%;">
                            <col span="1" style="width: 12.5%;">
                            <col span="1" style="width: 12.5%;">
                            <col span="1" style="width: 12.5%;">
                            <col span="1" style="width: 12.5%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price(100g)</th>
                                <th>kkal</th> <th>protein</th>
                                <th>carb</th>
                                <th>fat</th>

                                <th id="h_cellulose">cellulose</th>
                                <th id="h_water">water</th>
                                <?php
                                $vits_mins=array("A","E","K","D","C","Om3","Om6","B1","B2","B5","B6","B8","B9","B12","Mg","Na","Cl","Ca","K","S","P","Cu","I","Cr");
                                foreach ($vits_mins as $vit_or_min) {
                                ?>
                                    <th id="h_<?=$vit_or_min?>"  style="display: none"><?=$vit_or_min?></th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            $products = mysqli_query($soe, "SELECT * FROM `products` ORDER BY name");
                            $products = mysqli_fetch_all($products);
                            foreach ($products as $product) {
                            ?>
                                <tr class="tr-product <?= $product[2] ?>" id="<?= $product[0] ?>"

                                    name_of_product="<?= $product[1] ?>"
                                price_of_product="<?= $product[3] ?>"
                                kcal_of_product="<?= $product[5] ?>"

                                protein_of_product="<?= $product[7] ?>"
                                carb_of_product="<?= $product[8] ?>"
                                fat_of_product="<?= $product[6] ?>"

                                    water_of_product="<?= $product[10] ?>"
                                    cellulose_of_product="<?= $product[9] ?>"


                                    vitA_of_product="<?= $product[11] ?>"
                                    vitE_of_product="<?= $product[12] ?>"
                                    vitK_of_product="<?= $product[13] ?>"
                                    vitD_of_product="<?= $product[14] ?>"
                                    vitC_of_product="<?= $product[15] ?>"
                                    om3_of_product="<?= $product[16] ?>"
                                    om6_of_product="<?= $product[17] ?>"
                                    vitB1_of_product="<?= $product[18] ?>"
                                    vitB2_of_product="<?= $product[19] ?>"
                                    vitB5_of_product="<?= $product[20] ?>"
                                    vitB6_of_product="<?= $product[21] ?>"
                                    vitB8_of_product="<?= $product[22] ?>"
                                    vitB9_of_product="<?= $product[23] ?>"
                                    vitB12_of_product="<?= $product[24] ?>"

                                    mg_of_product="<?= $product[25] ?>"
                                    na_of_product="<?= $product[26] ?>"
                                    cl_of_product="<?= $product[27] ?>"
                                    ca_of_product="<?= $product[28] ?>"
                                    k_of_product="<?= $product[29] ?>"
                                    s_of_product="<?= $product[30] ?>"
                                    p_of_product="<?= $product[31] ?>"
                                    cu_of_product="<?= $product[32] ?>"
                                    i_of_product="<?= $product[33] ?>"
                                    cr_of_product="<?= $product[34] ?>"


                                >

                                    <td class="name" onclick="picture('<?= $product[4] ?>')">
                                        <?= $product[1] ?>

                                    </td>
                                    <td><img class="product-icon" src="image/groups/<?= $product[2] ?>.png" alt="<?= $product[2] ?>"></td>
                                    <td><?= $product[3] ?></td>
                                    <td><?= $product[5] ?></td>
                                    <td><?= $product[6] ?></td>
                                    <td><?= $product[7] ?></td>
                                    <td><?= $product[8] ?></td>

                                    <td class="b_cellulose"><?= $product[9] ?></td>
                                    <td class="b_water"><?= $product[10] ?></td>

                                    <?php
                                    $index_in_db=11;
                                    foreach ($vits_mins as $vit_or_min) {
                                        ?>
                                        <td  class="b_<?=$vit_or_min?>" style="display: none"><?= $product[$index_in_db] ?></td>
                                        <?php
                                        $index_in_db+=1;
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
    <!--
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <div class="modal-content" id=modal-content>

            <p>Some text in the Modal..</p>
        </div>
    </div>-->
    <div class="context-menu-open" id="contextmenuproducttr"></div>
    <script>
       /* let modal = document.getElementById("myModal");
        let span = document.getElementsByClassName("close")[0];

        function picture(url) {
            modal.style.display = "block";
            let li = '<img class="product" src="' + url + '" alt="[add a picture]">'
            $('#modal-content').html(li);
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }*/
        //DROPDOWN BTN

        function show_hide(id) {
            var click = document.getElementById(id);
            if(click.style.display ==="none") {
                click.style.display ="block";
            } else {
                click.style.display ="none";
            }

        }
        $(document).on('click', function() {
            document.getElementsByClassName('list-items-for-sort').style.display ="none";
        });
        $(document).on('scroll', function() {
            document.getElementsByClassName('list-items-for-sort').style.display ="none";
        });

    </script>



    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/contextmenu.js"></script>
    <script src="js/pagination.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>
    <script src="js/products.js"></script>
    <script src="js/sort_products.js"></script>
</body>

</html>
<?php require_once 'config/connect.php';
require_once 'config/nutr.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>
    <link rel="stylesheet" href="CSS/menu.css" type="text/css" />
    <link rel="stylesheet" href="CSS/modal.css" type="text/css" />
    <link rel="stylesheet" href="CSS/progress.css" type="text/css" />

    <title>Menu of week</title>

</head>

<body>
    <?php require_once 'blocks/preloader.php'; ?>
    <div class="container">
        <?php require_once 'blocks/header.php'; ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php'; ?>
            <div class="page">
                <?php require_once 'blocks/calc_nutr.php'; ?>

                <div class="card" style="width:100%;">
                    <label for="kkal">Protein/Fat/Carb(<?= $valuekkal ?>kkal)</label>
                    <div id="kkal" class="progress-bar progress-multiple" style="width:97.5%;">
                        <span class="progress progress-protein" style="width: <?= $percentprotein ?>%;"><?= $valueprotein ?>g</span>
                        <span class="progress progress-fat" style="width: <?= $percentfat ?>%;"><?= $valuefat ?>g</span>
                        <span class="progress progress-carb" style="width: <?= $percentcarb ?>%;"><?= $valuecarb ?>g</span>
                    </div>
                    <div class="grid-2">
                        <div>
                            <label for="water">Water:</label>
                            <div id="water" class="progress-bar">
                                <span class="progress progress-water" style="width:<?= $percentwater ?>%;"><?= $valuewater ?></span>
                            </div>
                        </div>
                        <div>
                            <label for="Cellulose">Cellulose:</label>
                            <div id="cell" class="progress-bar">
                                <span class="progress progress-cellulose" style="width: <?= $percentcellulose ?>%;"><?= $valuecellulose ?></span>
                            </div>
                        </div>
                        <div>
                            <label for="Vitamins:">Vitamins:</label>
                            <ion-icon onclick="allvit(<?php echo $Norm_vitA . ',' . $Norm_vitE . ',' . $Norm_vitK . ',' . $Norm_vitD . ',' . $Norm_vitC . ',' . $Norm_Om3 . ',' . $Norm_Om6 . ',' . $Norm_vitB1 . ',' . $Norm_vitB2 . ',' . $Norm_vitB5 . ',' . $Norm_vitB6 . ',' . $Norm_vitB8 . ',' . $Norm_vitB9 . ',' . $Norm_vitB12 . ',' . $valuevitA . ',' . $valuevitE . ',' . $valuevitK . ',' . $valuevitD . ',' . $valuevitC . ',' . $valueOm3 . ',' . $valueOm6 . ',' . $valuevitB1 . ',' . $valuevitB2 . ',' . $valuevitB5 . ',' . $valuevitB6 . ',' . $valuevitB8 . ',' . $valuevitB9 . ',' . $valuevitB12 ?>)" name="help-circle-outline"></ion-icon>
                            <div id="vit" class="progress-bar">
                                <span class="progress progress-vit" style="width: <?= $percentvit ?>%;"><?= $percentvit ?>%</span>
                            </div>
                        </div>
                        <div>
                            <label for="Minerals:">Minerals:</label>
                            <ion-icon onclick="allmin(<?= $Norm_minMg ?>, <?= $Norm_minNa ?>, <?= $Norm_minCl ?>, <?= $Norm_minCa ?>,<?= $Norm_minCu ?>,<?= $Norm_minCr ?>,<?= $Norm_minI ?>, <?= $Norm_minK ?>, <?= $Norm_minS ?>, <?= $Norm_minP ?>, <?= $valueminMg ?>, <?= $valueminNa ?>, <?= $valueminCl ?>, <?= $valueminCa ?>,<?= $valueminCu ?>,<?= $valueminCr ?>,<?= $valueminI ?>, <?= $valueminK ?>,<?= $valueminS ?>,<?= $valueminP ?>)" name="help-circle-outline"></ion-icon>
                            <div id="min" class="progress-bar">
                                <span class="progress progress-min" style="width: <?= $percentmin ?>%;"><?= $percentmin ?>%</span>
                            </div>
                        </div>

                    </div>
                    <label for="finanse:">Finanse:</label>
                    <div id="finanse" class="progress-bar">
                        <span class="progress" style="width: <?= $percentfin ?>%;"><?= $percentfin ?>%(<?= $valuefin ?>)</span>
                    </div>
                </div>
                <!-- menu's cards -->
                <?php
                $dishes = mysqli_query($soe, "SELECT * FROM `dishes`");
                $dishes = mysqli_fetch_all($dishes);
                ?>
                <div class="container" id="menu">
                    <div class="card-menu day time">
                        <div class="innercard card static">
                            <h6>Time/Day</h6>
                        </div>
                    </div>
                    <?php
                    foreach ($days as $day) {
                    ?>
                        <div class="card-menu day">
                            <div class="innercard">
                                <h6><?= $day ?></h6>
                            </div>
                        </div>
                    <?php
                    }
                    foreach ($times as $time) {
                    ?>
                        <div class="card-menu time">
                            <div class="innercard">
                                <h6><?= $time ?></h6>
                            </div>
                        </div>
                        <?php
                        foreach ($days as $dayweek) {

                            $dishes = mysqli_query($soe, "SELECT * FROM dishes,recipes WHERE dishes.RecipeID=recipes.ID AND dishes.Day='$dayweek' AND dishes.Time='$time';");
                            $dishes = mysqli_fetch_all($dishes);
                            $text = "";

                            foreach ($dishes as $dish) {
                                $text = $text . $dish[5];
                            }

                            if ($text == "") {
                                echo '<div class="card-menu"><div class="innercard add"><h6>Add</h6></div></div>';
                            } else {
                        ?>
                                <div class="card-menu dish">
                                    <!-- <ion-icon class="menu-ion" id="title" name="text-outline"></ion-icon>
                                    <ion-icon id="info-modal" onclick="openmodal(<?= $weight ?>,<?= $price ?>,<?= $water ?>,<?= $cellulose ?>,<?= $percvit ?>,<?= $percmin ?>,<?= $percfat ?>,<?= $perccarb ?>,<?= $percprotein ?>,<?= $fat ?>,<?= $carb ?>,<?= $protein ?>)" class="menu-ion" name="stats-chart-outline"></ion-icon>
                                    <ion-icon id="data" onclick="openmodalList('<?= $list ?>',<?= $weight ?>,<?= $price ?>)" class="menu-ion" name="list-outline"></ion-icon>
                                    <ion-icon class="menu-ion" id="edit" name="create-outline"></ion-icon>
                                    <a href="vendor/Delete_menucell.php?id=<?= $id ?>">
                                        <ion-icon class="menu-ion" id="delete" name="trash-outline"></ion-icon>
                                    </a> -->
                                    <div class="innercard title">
                                        <?= $text ?>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }

                    ?>
                    <?php

                    ?>
                </div>
            </div>

        </div>
    </div>
    <?= require_once 'blocks/modals/modal_menucell.php'; ?>
    <script>
        var modal = document.getElementById("ModalInfo");
        var span = document.getElementsByClassName("close")[0];

        function openmodal(weight, price, water, cell, percvit, percmin, percfat, perccarb, percprotein, fat, carb, protein) {
            modal.style.display = "block";

            let li = '<div class="info" id="info"><label for="kkal">Protein/Fat/Carb</label><div id="kkal" class="progress-bar progress-multiple" style="width:100%;"><span class="progress progress-protein"></span><span class="progress progress-fat"></span><span class="progress progress-carb"></span></div><div class="grid-2"><div><label for="Vitamins:">Vitamins:</label><div id="vit" class="progress-bar"><span class="progress progress-vit"></span></div></div><div><label for="Minerals:">Minerals:</label><div id="min" class="progress-bar"><span class="progress progress-min"></span></div></div></div></div><div class="info-data"><div id="wg" class="text">Weight</div><div id="pr" class="text">Price</div><div id="wt" class="text">Water</div><div id="cl" class="text">Cellulose</div></div>';
            $("#modal-content").html(li);

            $("#wg").text('Weight:' + weight);
            $("#pr").text('Price:' + price);
            $("#wt").text('Water:' + water);
            $("#cl").text('Cellulose:' + cell);
            //kkal
            $("#info .progress-protein").text(protein);
            $("#info .progress-fat").text(fat);
            $("#info .progress-carb").text(carb);
            $("#info .progress-protein").css("width", percprotein + "%")
            $("#info .progress-fat").css("width", percfat + "%")
            $("#info .progress-carb").css("width", perccarb + "%")
            //min
            $("#min .progress").text(percmin);
            $("#min .progress").css("width", percmin + "%")
            //vit
            $("#vit .progress").text(percvit);
            $("#vit .progress").css("width", percvit + "%")
        }

        function openmodalList(list, weight, price) {
            let li = '<div class="info-data"><div id="wg" class="text">Weight</div><div id="pr" class="text">Price</div></div>';
            $("#modal-content").html(li);
            list.replace(';', ';\n')
            modal.style.display = "block";
            $("#wg").text('Weight:' + weight);
            $("#pr").text('Price:' + price);
            $("#modal-content").text(list);
        }

        function allvit(a, e, k, d, c, om3, om6, b1, b2, b5, b6, b8, b9, b12, va, ve, vk, vd, vc, vom3, vom6, vb1, vb2, vb5, vb6, vb8, vb9, vb12) {
            let listnamevits = ['A', 'E', 'K', 'D', 'C', 'Omega 3', 'Omega 6', 'B1', 'B2', 'B5', 'B6', 'B8', 'B9', 'B12'];
            let listnormvits = [a, e, k, d, c, om3, om6, b1, b2, b5, b6, b8, b9, b12];
            let listvaluevits = [va, ve, vk, vd, vc, vom3, vom6, vb1, vb2, vb5, vb6, vb8, vb9, vb12];
            modal.style.display = "block";
            let li = '<div class="grid-2" id="vit">';
            for (let i = 0; i < listnamevits.length; i++) {
                let persent = listvaluevits[i] * 100 / listnormvits[i];
                persent = persent >= 100 ? 100 : persent;
                li += '<label for="vit_' + listnamevits[i] + ':">' + listnamevits[i] + ':</label><div id="vit_' + listnamevits[i] + '" class="progress-bar"><span class="progress" style="width:' + persent + '%;">' + listvaluevits[i] + '/' + listnormvits[i] + '</span></div>'

            }

            li += '</div>';
            $("#modal-content").html(li);
        }

        function allmin(mg, na, cl, ca, cu, cr, i, k, s, p, vmg, vna, vcl, vca, vcu, vcr, vi, vk, vs, vp) {
            let listnamemins = ['Mg', 'Na', 'Cl', 'Ca', 'Cu', 'Cr', 'I', 'K', 'S', 'P'];
            let listnormmins = [mg, na, cl, ca, cu, cr, i, k, s, p];
            let listvaluemins = [vmg, vna, vcl, vca, vcu, vcr, vi, vk, vs, vp];
            modal.style.display = "block";
            let li = '<div class="grid-2" id="min"> ';
            for (let i = 0; i < listnamemins.length; i++) {
                let persent = listvaluemins[i] * 100 / listnormmins[i];
                persent = persent >= 100 ? 100 : persent;
                li += '<label for="min_' + listnamemins[i] + ':">' + listnamemins[i] + ':</label><div id="min_' + listnamemins[i] + '" class="progress-bar"><span class="progress" style="width:' + persent + '%;">' + listvaluemins[i] + '/' + listnormmins[i] + '</span></div>'

            }
            li += '</div>';
            $("#modal-content").html(li);
        }

        span.onclick = function() {
            modal.style.display = "block";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>



    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>

</body>

</html>
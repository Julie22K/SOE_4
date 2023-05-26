<?php require './config/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'blocks/head.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Menu of week</title>
</head>
<body>
    <?php require_once 'blocks/preloader.php'; ?>
    <div class="container">
        <?php require_once 'blocks/header.php'; ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php'; ?>
            <div class="page" id="menu_page">
                <div class="anti-card row m-0 p-0" id="btnsPart">
                    <button onclick="activateCardPart('all_analitic')" id="btnAll" class="btn menu-info-btn">All</button>
                    <button onclick="activateCardPart('vitamins')" id="btnVit" class="btn menu-info-btn">Vitamins</button>
                    <button onclick="activateCardPart('minerals')" id="btnMin" class="btn menu-info-btn">Minerals</button>
                </div>
                <div class="card-header col m-x-0 p-x-0"  id="card_analitic">
                        <div class="anti-card menu-info-card row" id="all_analitic" style="display: contents">
                            <div id="kprc" class="circle circle-l"></div>
                            <div id="mins" class="circle circle-m"></div>
                            <div id="vits" class="circle circle-m"></div>
                            <div id="water" class="circle circle-s"></div>
                            <div id="cellulose" class="circle circle-s"></div>
                            <div id="sugar" class="circle circle-s"></div>
                        </div>
                        <div class="anti-card menu-info-card" id="minerals">
                        </div>
                        <div class="anti-card menu-info-card" id="vitamins">
                        </div>
                </div>
                <div class="anti-card row m-0 p-0">
                    <form class="form-inline" action="" method="post">
                        <button class="btn" disabled>Choose days</button>
                    </form>
                    <form class="form-inline" action="" method="post">
                        <button class="btn" disabled>Previous week</button>
                    </form>
                    <form class="form-inline" action="" method="post">
                        <button class="btn" disabled>Next week</button>
                    </form>
                    <form class="form-inline" action="vendor/Clear_dishes_and_shoplist.php" method="post">
                        <button class="btn">Clear menu</button>
                    </form>
                </div>
                <div class="anti-card grid grid-8 m-x-0 p-x-0" id="menu">
                    <div class="card card-daytime"><h6 class="text-center">30.01-5.02</h6></div>
                    <?php

                    foreach ($days as $day) {
                        ?>
                        <div class="card card-day">
                                <h6 class="text-center"><?= $day ?></h6>
                        </div>
                        <?php
                    }
                    foreach ($times as $time) {
                        ?>
                        <div class="card card-time">
                                <h6 class="text-center"><?= $time ?></h6>
                        </div>
                        <?php
                        foreach ($days as $dayweek) {

                            $dishes = mysqli_query($soe, "SELECT * FROM dishes,recipes WHERE dishes.RecipeID=recipes.ID AND dishes.Day='$dayweek' AND dishes.Time='$time';");
                            $dishes = mysqli_fetch_all($dishes);
                            $text_array = array();
                            $number=count($dishes);
                            foreach ($dishes as $dish) {
                                array_push($text_array,$dish[5]);
                            }
                            $text="";
                            foreach($text_array as $t) {
                                    $text=$text . "<li>" . $t . "</li>";
                            }
                            if ($text == "") {
                                echo '<div class="add-card add-card-menu invisible card-drag" id="' . $dayweek . '_' . $time . '" onclick="add_dish_from_menu(\'' . $dayweek . '\',\'' . $time . '\')"><h6>Add</h6></div>';
                            } else {
                                ?>
                                <div class="card card-dish card-drag" draggable="true" onclick="dish_context_menu('<?= $dayweek ?>','<?= $time ?>')" day="<?= $dayweek ?>" time="<?= $time ?>" number_dishes="<?= $number ?>" id="<?= $dish[0] ?>">
                                   <ul class="text-center"><?= $text ?></ul>

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

    <div class="context-menu-open" id="contextmenumenucell"></div>
    <?php
    $fulldata = mysqli_query($soe, "select * from menu_fulldata");
    $fulldata = mysqli_fetch_assoc($fulldata);

    $vitmin = mysqli_query($soe, "select * from menu_vits_and_mins");
    $vitmin = mysqli_fetch_assoc($vitmin);
    ?>
    <script src="js/modal.js"></script>
    <div id="myModalAddDish" class="modal">
        <div class="modal-content" id=modal-content>
            <div class="modal-header" id="modal_header">
                <h3>Add:</h3>
            </div>
            <form class="form-add" name="add_dish">
                <div class="modal-body col" id="modal_body">
                    <div class="row">
                    <div class="col">
                        <label for="dish_day">Day</label>
                        <input type="text" id="dish_day" name="day" class="int" placeholder="day" value="">
                    </div>
                    <div class="col">
                        <label for="dish_time">Time</label>
                        <input type="text" id="dish_time" name="time" class="int" placeholder="time" value="">
                    </div>
                </div>
                    <div class="row m-3">
                        <select class="__select2 m-3" name="recipe_id" style="width: 100%">
                            <option value="other" default>Choose...</option>
                                <?php
                                $recipes=mysqli_query($soe, "SELECT * FROM `recipes`");
                                $recipes = mysqli_fetch_all($recipes);
                                foreach ($recipes as $recipe) {
                                    ?>
                                    <option value="<?= $recipe[0] ?>"><?= $recipe[1] ?></option>
                                    <?php
                                }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer row" id="modal_footer">
                    <button type="submit" class="btn" onclick="Ajax_Add_Dish()">Add</button>
                    <button type="button" class="btn btn-cancel" onclick="closeModal('myModalAddDish')">Close</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        
        
        
        function activateCardPart(part_id){
            $('.menu-info-card').css('display','none');
            console.log(part_id);
            if(part_id==='all_analitic') $("#"+part_id).css('display','contents');
            else $("#"+part_id).css('display','block');
            console.log($("#"+part_id).outerHTML)
        }
        activateCardPart('all_analitic');
        
        
        const bigsize='230',midsize='190',smallsize='160';
        var options = {
            series: [<?=round($fulldata['kcal'],1)?>, <?=round($fulldata['protein'],1)?>, <?=round($fulldata['carb'],1)?>, <?=round($fulldata['fat'],1)?>],
            chart: {
                height: bigsize,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    startAngle: 0,
                    endAngle: 270,
                    hollow: {
                        margin: 5,
                        size: '20%',
                        background: 'transparent',
                        image: undefined,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            show: false,
                        }
                    }
                }
            },
            colors: ['#7B58AD', '#FF4F4F', '#4664CF', '#F2E041'],
            labels: ['Kcal', 'Protein', 'Carbonation', 'Fat'],
            legend: {
                show: true,
                floating: true,
                fontSize: '10px',
                position: 'left',
                offsetX: 0,
                offsetY: -10,
                labels: {
                    useSeriesColors: true,
                },
                markers: {
                    size: 0
                },
                formatter: function(seriesName, opts) {
                    return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                },
                itemMargin: {
                    vertical: 3
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: false
                    }
                }
            }]
        };
        var kcal = new ApexCharts(document.querySelector("#kprc"), options);
        kcal.render();
        //minerals
        var vitamins = {
            series: [<?=round($vitmin['vitamins'],1)?>],
            chart: {
                height: midsize,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '40%',
                    }
                },
            },
            colors:['#B14FFF'],
            labels: ['Vitamins'],
        };
        var vits = new ApexCharts(document.querySelector("#vits"), vitamins);
        vits.render();
        //vitamins
        var minerals = {
            colors:['#FF4F99'],
            series: [<?=round($vitmin['minerals'],1)?>],
            chart: {
                height: midsize,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '40%',
                    }
                },
            },
            labels: ['Minerals'],
        };

        var mins = new ApexCharts(document.querySelector("#mins"), minerals);
        mins.render();
        //water
        var water = {
            series: [<?=round($fulldata['water'],1)?>],
            chart: {
                height: smallsize,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '40%',
                    }
                },
            },
            labels: ['Water'],
        };

        var wtr = new ApexCharts(document.querySelector("#water"), water);
        wtr.render();
        //cellulose
        var cellulose = {
            series: [<?=round($fulldata['cellulose'],1)?>],
            chart: {
                height: smallsize,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '40%',
                    }
                },
            },
            colors:['#83C73F'],
            labels: ['Cellulose'],
        };

        var cls = new ApexCharts(document.querySelector("#cellulose"), cellulose);
        cls.render();
        //water
        var sugar = {
            series: [50],
            chart: {
                height: smallsize,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '40%',
                    }
                },
            },
            colors:['#3F9D7B'],
            labels: ['Sugar'],
        };

        var sgr = new ApexCharts(document.querySelector("#sugar"), sugar);
        sgr.render();
        //vitamis
        var vitammins = {
            series: [{
                name: 'Inflation',
                data: [<?=round($fulldata['vitA'],1)?>,
                    <?=round($fulldata['vitE'],1)?>,
                    <?=round($fulldata['vitK'],1)?>,
                    <?=round($fulldata['vitD'],1)?>,
                    <?=round($fulldata['vitC'],1)?>,
                    <?=round($fulldata['om3'],1)?>,
                    <?=round($fulldata['om6'],1)?>,
                    <?=round($fulldata['vitB1'],1)?>>100?100:<?=round($fulldata['vitB1'],1)?>,
                    <?=round($fulldata['vitB2'],1)?>,
                    <?=round($fulldata['vitB5'],1)?>,
                    <?=round($fulldata['vitB6'],1)?>,
                    <?=round($fulldata['vitB12'],1)?>]
            }],
            chart: {
                height: 200,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 2,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["vit A", "vit E", "vit K", "vit D", "vit C", "omega 3", "omega 6",
                    "vit B1", "vit B2", "vit B5", "vit B6", "vit B8", "vit B9", "vit B12"],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function (val) {
                        return val + "%";
                    }
                }

            },
            title: {
                floating: true,
                offsetY:230,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#vitamins"), vitammins);
        chart.render();
        //minerals
        var minerrals = {
            series: [{
                name: 'Inflation',
                data: [<?=round($fulldata['minMg'],1)?>,
                    <?=round($fulldata['minNa'],1)?>,
                    <?=round($fulldata['minCa'],1)?>,
                    <?=round($fulldata['minCl'],1)?>,
                    <?=round($fulldata['minK'],1)?>,
                    <?=round($fulldata['minS'],1)?>>100?100:<?=round($fulldata['minS'],1)?>,
                    <?=round($fulldata['minP'],1)?>,
                    <?=round($fulldata['minCu'],1)?>,
                    <?=round($fulldata['minI'],1)?>,
                    <?=round($fulldata['minCr'],1)?>]
            }],
            chart: {
                height: 200,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 2,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["Mg", "Na", "Cl", "Ca", "K", "S", "P", "Cu", "I", "Cr"],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function (val) {
                        return val + "%";
                    }
                }

            },
            title: {
                floating: true,
                offsetY:230,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#minerals"), minerrals);
        chart.render();
    </script>
    <script>
        $(document).ready(function() {
            $('.__select2').select2();
        });
        function add_dish_from_menu(day,time) {
            openModal('myModalAddDish');
            $("#dish_day").val(day);
            $("#dish_time").val(time);

            addContentToModal('Add for '+day+'('+time+')','','');
        }
        function Ajax_Add_Dish() {

            var formData = new FormData(document.forms.add_dish);
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open('post', 'php_ajax/Create_dish.php',true);
            xmlhttp.send(formData);
            closeModal('myModalAddDish');

        }
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/contextmenu.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>
    <script src="js/delete_dish.js"></script>
    <script src="js/change_dish.js"></script>
    <script src="js/drag_dish.js"></script>

</body>

</html>
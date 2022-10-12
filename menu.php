<?php
require_once 'config/connect.php';

//require_once 'config/nutr.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XWZ14BWCYX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XWZ14BWCYX');
    </script>
    <?php require_once 'blocks/head.php' ?>
    <link rel="stylesheet" href="CSS/menu.css" type="text/css" />
    <link rel="stylesheet" href="CSS/modal.css" type="text/css" />
    <link rel="stylesheet" href="CSS/progress.css" type="text/css" />
    <link rel="stylesheet" href="CSS/forms.css" type="text/css" />

    <link rel="stylesheet" href="CSS/analysis.css" type="text/css" />
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
            <div class="page">
                <div id="card_analysis" class=""><!--style="min-width: 90%;"-->
                    <div class="card-part" id="allanalitic">
                        <div id="kprc" class="circle"></div>
                        <div id="mins" class="circle"></div>
                        <div id="vits" class="circle"></div>
                        <div id="water" class="circle"></div>
                        <div id="cellulose" class="circle"></div>
                        <div id="sugar" class="circle"></div>
                    </div>
                    <div class="card-part" id="minerals">

                    </div>
                    <div class="card-part" id="vitamins">

                    </div>

                    <div id="btnsPart">
                        <button onclick="activateCardPart('allanalitic')" id="btnAll" class="button"><div>A<br>l<br>l<br></div></button>
                        <button onclick="activateCardPart('minerals')" id="btnMin" class="button"><div>M<br>i<br>n<br>e<br>r<br>a<br>l<br>s<br></div></button>
                        <button onclick="activateCardPart('vitamins')" id="btnVit" class="button"><div>V<br>i<br>t<br>a<br>m<br>i<br>n<br>s<br></div></button>
                    </div>

                </div>
                <!-- menu's cards -->

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
                                echo '<div class="card-menu"><div class="innercard add" onclick="add_dish_from_menu(' . $dayweek . ',' . $time . ')"><h6>Add</h6></div></div>';
                            } else {
                        ?>
                                <div class="card-menu dish" day="<?= $dayweek ?>" time="<?= $time ?>" id="<?= $dish[0] ?>">
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
                <form action="vendor/Clear_dishes_and_shoplist.php" method="post">
                    <button>Clear menu</button>
                </form>
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
    <script type="text/javascript">
        const bigsize=230,midsize=190,smallsize=160;

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
                        size: '30%',
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
            series: [
                {
                    data: [
                        {
                            x: 'A',
                            y: <?=round($fulldata['vitA'],1)?>
                        },
                        {
                            x: 'E',
                            y: <?=round($fulldata['vitE'],1)?>
                        },
                        {
                            x: 'K',
                            y: <?=round($fulldata['vitK'],1)?>
                        },
                        {
                            x: 'D',
                            y: <?=round($fulldata['vitD'],1)?>
                        },
                        {
                            x: 'C',
                            y: <?=round($fulldata['vitC'],1)?>
                        },
                        {
                            x: 'Omega 3',
                            y: <?=round($fulldata['om3'],1)?>
                        },
                        {
                            x: 'Omega 6',
                            y: <?=round($fulldata['om6'],1)?>
                        },
                        {
                            x: 'B1',
                            y: <?=round($fulldata['vitB1'],1)?>
                        },
                        {
                            x: 'B2',
                            y: <?=round($fulldata['vitB2'],1)?>
                        },
                        {
                            x: 'B5',
                            y: <?=round($fulldata['vitB5'],1)?>
                        },
                        {
                            x: 'B6',
                            y: <?=round($fulldata['vitB6'],1)?>
                        },
                        {
                            x: 'B8',
                            y: <?=round($fulldata['vitB8'],1)?>
                        },
                        {
                            x: 'B9',
                            y: <?=round($fulldata['vitB9'],1)?>
                        },
                        {
                            x: 'B12',
                            y: <?=round($fulldata['vitB12'],1)?>
                        }
                    ]
                }
            ],
            toolbar: {
                show: false
            },
            legend: {
                show: false
            },
            chart: {
                height: 220,
                width:925,
                type: 'treemap',
                toolbar: {
                    show: false
                }
            },
            /*title: {
                text: 'Vitamins'
            },*/
            colors: ['#B14FFF'],
            tooltip: {
                y: {
                    formatter: function(value, opts) {
                        const sum = opts.series[0].reduce((a, b) => a + b, 0);
                        const percent = value * 1;
                        return percent.toFixed(0) + '%'
                    },
                },
            }
        };

        var vts = new ApexCharts(document.querySelector("#vitamins"), vitammins);
        vts.render();
        //minerals
        var minerrals = {
            series: [
                {
                    data: [
                        {
                            x: 'Mg',
                            y: <?=round($fulldata['minMg'],1)?>
                        },
                        {
                            x: 'Na',
                            y: <?=round($fulldata['minNa'],1)?>
                        },
                        {
                            x: 'Ca',
                            y: <?=round($fulldata['minCa'],1)?>
                        },
                        {
                            x: 'Cl',
                            y: <?=round($fulldata['minCl'],1)?>
                        },
                        {
                            x: 'K',
                            y: <?=round($fulldata['minK'],1)?>
                        },
                        {
                            x: 'S',
                            y: <?=round($fulldata['minS'],1)?>>100?100:<?=round($fulldata['minS'],1)?>
                        },
                        {
                            x: 'P',
                            y: <?=round($fulldata['minP'],1)?>
                        },
                        {
                            x: 'Cu',
                            y: <?=round($fulldata['minCu'],1)?>
                        },
                        {
                            x: 'Cr',
                            y: <?=round($fulldata['minCr'],1)?>
                        },
                        {
                            x: 'I',
                            y: <?=round($fulldata['minI'],1)?>
                        }
                    ]
                }
            ],
            legend: {
                show: false
            },
            chart: {
                height: 220,
                width:925,
                type: 'treemap',
                toolbar: {
                    show: false
                }
            },
            /*title: {
                text: 'Minerals'
            },*/
            colors: ['#FF4F99'],
            tooltip: {
                y: {
                    formatter: function(value, opts) {
                        const sum = opts.series[0].reduce((a, b) => a + b, 0);
                        const percent = value * 1;
                        return percent.toFixed(0) + '%'
                    },
                },
            }

        };

        var mns = new ApexCharts(document.querySelector("#minerals"), minerrals);
        mns.render();
    </script>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/contextmenu.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>
    <script src="js/card_parts.js"></script>

</body>

</html>
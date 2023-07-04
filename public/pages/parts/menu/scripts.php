
    <script>
        function activateCardPart(part_id) {
            $('.menu-info-card').css('display', 'none');
            console.log(part_id);
            if (part_id === 'all_analitic') $("#" + part_id).css('display', 'contents');
            else $("#" + part_id).css('display', 'block');
            console.log($("#" + part_id).outerHTML)
        }
        activateCardPart('all_analitic');


        const bigsize = '230',
            midsize = '190',
            smallsize = '160';
        var options = {
            series: [<?= round($fulldata['kcal'], 1) ?>, <?= round($fulldata['protein'], 1) ?>, <?= round($fulldata['carb'], 1) ?>, <?= round($fulldata['fat'], 1) ?>],
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
            series: [<?= round($vitmin['vitamins'], 1) ?>],
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
            colors: ['#B14FFF'],
            labels: ['Vitamins'],
        };
        var vits = new ApexCharts(document.querySelector("#vits"), vitamins);
        vits.render();
        //vitamins
        var minerals = {
            colors: ['#FF4F99'],
            series: [<?= round($vitmin['minerals'], 1) ?>],
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
            series: [<?= round($fulldata['water'], 1) ?>],
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
            series: [<?= round($fulldata['cellulose'], 1) ?>],
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
            colors: ['#83C73F'],
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
            colors: ['#3F9D7B'],
            labels: ['Sugar'],
        };

        var sgr = new ApexCharts(document.querySelector("#sugar"), sugar);
        sgr.render();
        //vitamis
        var vitammins = {
            series: [{
                name: 'Inflation',
                data: [<?= round($fulldata['vitA'], 1) ?>,
                    <?= round($fulldata['vitE'], 1) ?>,
                    <?= round($fulldata['vitK'], 1) ?>,
                    <?= round($fulldata['vitD'], 1) ?>,
                    <?= round($fulldata['vitC'], 1) ?>,
                    <?= round($fulldata['om3'], 1) ?>,
                    <?= round($fulldata['om6'], 1) ?>,
                    <?= round($fulldata['vitB1'], 1) ?> > 100 ? 100 : <?= round($fulldata['vitB1'], 1) ?>,
                    <?= round($fulldata['vitB2'], 1) ?>,
                    <?= round($fulldata['vitB5'], 1) ?>,
                    <?= round($fulldata['vitB6'], 1) ?>,
                    <?= round($fulldata['vitB12'], 1) ?>
                ]
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
                formatter: function(val) {
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
                    "vit B1", "vit B2", "vit B5", "vit B6", "vit B8", "vit B9", "vit B12"
                ],
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
                    formatter: function(val) {
                        return val + "%";
                    }
                }

            },
            title: {
                floating: true,
                offsetY: 230,
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
                data: [<?= round($fulldata['minMg'], 1) ?>,
                    <?= round($fulldata['minNa'], 1) ?>,
                    <?= round($fulldata['minCa'], 1) ?>,
                    <?= round($fulldata['minCl'], 1) ?>,
                    <?= round($fulldata['minK'], 1) ?>,
                    <?= round($fulldata['minS'], 1) ?> > 100 ? 100 : <?= round($fulldata['minS'], 1) ?>,
                    <?= round($fulldata['minP'], 1) ?>,
                    <?= round($fulldata['minCu'], 1) ?>,
                    <?= round($fulldata['minI'], 1) ?>,
                    <?= round($fulldata['minCr'], 1) ?>
                ]
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
                formatter: function(val) {
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
                    formatter: function(val) {
                        return val + "%";
                    }
                }

            },
            title: {
                floating: true,
                offsetY: 230,
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
        function add_dish_from_menu(day, time) {
            openModal('myModalAddDish');
            $("#dish_day").val(day);
            $("#dish_time").val(time);

            addContentToModal('Add for ' + day + '(' + time + ')', '', '');
        }

        function Ajax_Add_Dish() {

            var formData = new FormData(document.forms.add_dish);
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open('post', 'php_ajax/Create_dish.php', true);
            xmlhttp.send(formData);
            closeModal('myModalAddDish');

        }
    </script>

<?php require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Data;
use App\Models\Product; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Setting</title>

</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>

    <div class="container" id="setting">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page " id="setting_page">
                <div class="anti-card col m-3 p-3">
                    <div>
                        <h4>Теми:</h4>
                    </div>
                    <div class="row">
                        <button class="btn btn-color" onclick="theme('#ffa927','#fff127','#F2F3A5','#fff673','#ffce73')" id="yellow_orange"><span>orange</span>
                        </button>
                        <button class="btn btn-color" onclick="theme('#BD2828','#381f1f','#EDABAB','#ffd2cf','#e72f2f')" id="red"><span>red</span>
                        </button>
                        <button class="btn btn-color" onclick="theme('#3E793F','#527445','#C2D4B3','#E5D3C9','#54b455')" id="green"><span>green</span>
                        </button>
                        <button class="btn btn-color" onclick="theme('#447C99','#222b3b','#9CC9E0','#9CC9E0','#36a7e1')" id="blue"><span>blue</span>
                        </button>
                        <button class="btn btn-color" onclick="theme('#7B58AD','#392838','#C8B3E5','#C8B3E5','#7e3bdc')" id="purple"><span>purple</span>
                        </button>
                        <button class="btn btn-color" onclick="theme('#323232','#7a8888','#cccccc','#cccccc','#7e7e7e')" id="gray"><span>gray</span>
                        </button>
                    </div>
                    <div class="row">
                        <button class="btn btn-color" onclick="theme('#DA2A2A','#381f1f','#64C264','#B2E1B2','#DA2A2A')" id="red_green"><span>red-green</span>
                        </button>
                        <button class="btn btn-color" onclick="theme('#277F27','#527445','#532496','#A992CB','#93B914')" id="green_purple"><span>green-purple</span>
                        </button>
                        <button class="btn btn-color" onclick="theme('#447C99','#222b3b','#ffa927','#FFD493','#0E72A7')" id="blue_orange"><span>blue-orange</span>
                        </button>
                        <button class="btn btn-color" onclick="theme('#7B58AD','#392838','#FFF040','#FFFAC0','#7e3bdc')" id="purple_yellow"><span>purple-yellow</span>
                        </button>
                        <button class="btn btn-color" onclick="theme('#666666','#dfdf59','#F2F3A5','#a09fa3','#d7d77c')" id="yellow_gray"><span>gray-yellow</span>
                        </button>


                        <!--theme(--main,main2(border),front-card,back-card)  -->
                        <!--theme(--main,main2(border),title-card,data-card,info-card)  -->

                        <!-- <button class="color" onclick="theme('#F5F5F5','#000000','#ffffff','#ffffff')" id="light">light</button>
                        <button class="color" onclick="theme('#F5F5F5','#000000','#ffffff','#ffffff')" id="dark">dark</button> -->
                    </div>
                </div>
                <!--
                <div class="anti-card col">
                    <h4>Disable icons:</h4>
                    <div>
                        <label class="switch">
                            <input type="checkbox disabled">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>-->
                <!--<div class="anti-card col">

                    <h4>Language:</h4>
                    <select id="lang">
                        <option>Choose language</option>
                        <option value="/en/">English</option>
                        <option value="/es/">Español</option>
                        <option value="/de/">Deutsch</option>
                        <option value="/it/">Italiano</option>
                        <option value="/nl/">Nederlandse</option>
                    </select>
                </div>-->
                <div class="anti-card col m-3 p-3">

                    <h4>Часи прийому їжі:</h4>
                    <button class="btn m-3 w-half" onclick='location.href="meal_times.php"'>Налаштувати</button>
                </div>
                <div class="anti-card col m-3 p-3">

                    <h4>База даних:</h4>
                    <button class="btn m-3 w-half" onclick='location.href="../../vendor/database/clear.php"'>Перезапустити</button>
                </div>
            </div>
        </div>
    </div>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>

</body>

</html>
<?php
require_once 'config/connect.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>
    <title>Setting</title>

</head>

<body>
    <?php require_once 'blocks/preloader.php' ?>

    <div class="container" id="setting">
        <?php require_once 'blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php' ?>
            <div class="page " id="setting_page">
                <div class="">
                    <div><h4>Themes:</h4></div
                    <div class="row">
                        <button class="btn btn-color" onclick="theme('#BD2828','#381f1f','#EDABAB','#9ba08a','#e72f2f')" id="red">red</button>
                        <button class="btn btn-color" onclick="theme('#3E793F','#527445','#C2D4B3','#E5D3C9','#54b455')" id="green">green</button>
                        <button class="btn btn-color" onclick="theme('#447C99','#222b3b','#9CC9E0','#9CC9E0','#36a7e1')" id="blue">blue</button>
                        <button class="btn btn-color" onclick="theme('#7B58AD','#392838','#C8B3E5','#C8B3E5','#7e3bdc')" id="purple">purple</button>
                        <button class="btn btn-color" onclick="theme('#666666','#dfdf59','#F2F3A5','#a09fa3','#d7d77c')" id="yellow">yellow</button>
                        <button class="btn btn-color" onclick="theme('#323232','#7a8888','#cccccc','#cccccc','#7e7e7e')" id="gray">gray</button>
                        <!--theme(--main,main2(border),front-card,back-card)  -->
                        <!--theme(--main,main2(border),title-card,data-card,info-card)  -->

                        <!-- <button class="color" onclick="theme('#F5F5F5','#000000','#ffffff','#ffffff')" id="light">light</button>
                        <button class="color" onclick="theme('#F5F5F5','#000000','#ffffff','#ffffff')" id="dark">dark</button> -->
                    </div>
                </div><!--
                <div class="anti-card col">
                    <h4>Disable icons:</h4>
                    <div>
                        <label class="switch">
                            <input type="checkbox disabled">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>-->
                <div class="anti-card col">
                    <!--
                <h4>Language:</h4>
                <select id="lang">
                    <option>Choose language</option>
                    <option value="/en/">English</option>
                    <option value="/es/">Español</option>
                    <option value="/de/">Deutsch</option>
                    <option value="/it/">Italiano</option>
                    <option value="/nl/">Nederlandse</option>
                </select> -->
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/contextmenu.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>

</body>

</html>
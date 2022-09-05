<?php
require_once 'config/connect.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>
    <link rel="stylesheet" href="CSS/setting.css" type="text/css" />
    <link rel="stylesheet" href="CSS/setting_switch.css" type="text/css" />
    <title>Setting</title>

</head>

<body>
    <?php require_once 'blocks/preloader.php' ?>

    <div class="container">
        <?php require_once 'blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php' ?>
            <div class="page">
                <h4>Themes:</h4>
                <!--theme(--main,main2(border),front-card,back-card)  -->
                <!--theme(--main,main2(border),title-card,data-card,info-card)  -->
                <button class="color" onclick="theme('#BD2828','#381f1f','#EDABAB','#9ba08a')" id="red">red</button>
                <button class="color" onclick="theme('#3E793F','#527445','#C2D4B3','#E5D3C9')" id="green">green</button>
                <button class="color" onclick="theme('#447C99','#222b3b','#9CC9E0','#9CC9E0')" id="blue">blue</button>
                <button class="color" onclick="theme('#7B58AD','#392838','#C8B3E5','#C8B3E5')" id="violet">violet</button>

                <button class="color" onclick="theme('#666666','#dfdf59','#F2F3A5','#a09fa3')" id="yellow">yellow</button>
                <button class="color" onclick="theme('#323232','#7a8888','#cccccc','#cccccc')" id="grey">grey</button>
                <!-- <button class="color" onclick="theme('#F5F5F5','#000000','#ffffff','#ffffff')" id="light">light</button>
                <button class="color" onclick="theme('#F5F5F5','#000000','#ffffff','#ffffff')" id="dark">dark</button> -->
                <h4>Disable icons:</h4>
                <label class="switch">
                    <input type="checkbox disabled">
                    <span class="slider round"></span>
                </label>
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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/contextmenu.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>

</body>

</html>
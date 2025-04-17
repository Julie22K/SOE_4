<?php
require '../blocks/pre_head.php';
$page_title = "Налаштування";


require '../blocks/head.php';

use App\Data;
use App\Models\Product;
?>
<div class="page " id="setting_page">
    <div class="anti-card col m-3 p-3">
        <div>
            <h4>Теми:</h4>
        </div>
        <div class="row">
            <button class="btn-color" onclick="theme('yellow')" id="yellow_orange"><span>Помаранчева</span>
            </button>
            <button class="btn-color" onclick="theme('red')" id="red"><span>Червона</span>
            </button>
            <button class="btn-color" onclick="theme('green')" id="green"><span>Зелена</span>
            </button>
            <button class="btn-color" onclick="theme('blue')" id="blue"><span>Блакитна</span>
            </button>
            <button class="btn-color" onclick="theme('purple')" id="purple"><span>Фіолетова</span>
            </button>
            <button class="btn-color" onclick="theme('gray')" id="gray"><span>Сіра</span>
            </button>
        </div><?php
                if ($_SESSION['user']['login'] == "admin") {
                ?>
            <div class="row">
                <button class="btn btn-color" onclick="theme('#DA2A2A','#381f1f','#64C264','#B2E1B2','#DA2A2A')" id="red_green"><span>Червоно - зелена</span>
                </button>
                <button class="btn btn-color" onclick="theme('#277F27','#527445','#532496','#A992CB','#93B914')" id="green_purple"><span>Зелено - фіолетова</span>
                </button>
                <button class="btn btn-color" onclick="theme('#447C99','#222b3b','#ffa927','#FFD493','#0E72A7')" id="blue_orange"><span>Блакитно - помаранчева</span>
                </button>
                <button class="btn btn-color" onclick="theme('#7B58AD','#392838','#FFF040','#FFFAC0','#7e3bdc')" id="purple_yellow"><span>Фіолетово - жовта</span>
                </button>
                <button class="btn btn-color" onclick="theme('#666666','#dfdf59','#F2F3A5','#a09fa3','#d7d77c')" id="yellow_gray"><span>Сіра - жовта</span>
                </button>


                <!--theme(--main,main2(border),front-card,back-card)  -->
                <!--theme(--main,main2(border),title-card,data-card,info-card)  -->

                <!-- <button class="color" onclick="theme('#F5F5F5','#000000','#ffffff','#ffffff')" id="light">light</button>
                        <button class="color" onclick="theme('#F5F5F5','#000000','#ffffff','#ffffff')" id="dark">dark</button> -->
            </div>
        <?php
                }
        ?>
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

        <h4>Режим харчування:</h4>
        <button class="btn m-3 w-half" onclick='location.href="meal_times.php"'>Налаштувати</button>
    </div>
    <?php
    if ($_SESSION['user']['login'] == "admin") {
    ?>
        <div class="anti-card col m-3 p-3">

            <h4>База даних:</h4>
            <button class="btn m-3 w-half" onclick='location.href="../../vendor/database/clear.php"'>Перезапустити</button>
        </div>
    <?php
    }
    ?>
</div>
<?php require '../blocks/fotter.php'; ?>
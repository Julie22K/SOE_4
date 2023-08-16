<div class="anti-card row m-2 w-full" id="btnsPart">
    <button onclick="activateCardPart('all_analitic')" id="btnAll" class="btn btn-small menu-info-btn m-2 p-2">Загальна інформація</button>
    <button onclick="activateCardPart('vitamins')" id="btnVit" class="btn btn-small menu-info-btn m-2 p-2">Вітаміни</button>
    <button onclick="activateCardPart('minerals')" id="btnMin" class="btn btn-small menu-info-btn m-2 p-2">Мінерали</button>
</div>
<div class="card-header col m-3 w-full" id="card_analitic">
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
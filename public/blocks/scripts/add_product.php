<?php

use App\Models\Manufacturer;
use App\Models\Shop;

?>
<script type="text/javascript">
    var selectCounter = 1;

    function addPrice(list) {
        const prices_list = document.getElementById('prices_list');

        var elem = document.createElement('div');
        elem.className = 'row j-c-ar a-items-baseline';

        var inputPrice = document.createElement('input');
        inputPrice.className = 'm-2';
        inputPrice.type = 'number';
        inputPrice.name = 'prices[]';
        inputPrice.placeholder = 'Ціна';
        inputPrice.min = 0;
        inputPrice.step = 0.01;
        elem.appendChild(inputPrice);

        var inputWeight = document.createElement('input');
        inputWeight.className = 'm-2';
        inputWeight.type = 'number';
        inputWeight.name = 'weights[]';
        inputWeight.placeholder = 'Вага (г)';
        inputWeight.min = 0;
        inputWeight.step = 1;
        elem.appendChild(inputWeight);

        var selectManufacturer = document.createElement('select');
        selectManufacturer.id = 'select2_for_manufacturer_' + selectCounter; // Унікальний ідентифікатор
        selectManufacturer.className = 'select2-add m-2';
        selectManufacturer.name = 'manufacturers[]';
        <?php
        $manufacturers = Manufacturer::all();
        foreach ($manufacturers as $manufacturer) {
        ?>
            var option = document.createElement('option');
            option.value = '<?= $manufacturer->id ?>';
            option.text = '<?= $manufacturer->name ?>';
            selectManufacturer.appendChild(option);
        <?php
        }
        ?>
        elem.appendChild(selectManufacturer);

        var selectShop = document.createElement('select');
        selectShop.id = 'select2_for_shop_' + selectCounter; // Унікальний ідентифікатор
        selectShop.className = 'select2-add m-2';
        selectShop.name = 'shops[]';
        <?php
        $shops = Shop::all();
        foreach ($shops as $shop) {
        ?>
            var option = document.createElement('option');
            option.value = '<?= $shop->id ?>';
            option.text = '<?= $shop->name ?>';
            selectShop.appendChild(option);
        <?php
        }
        ?>
        elem.appendChild(selectShop);

        var btn = document.createElement('button');
        btn.className = 'btn m-2';
        btn.innerHTML = '<ion-icon name="close-outline"></ion-icon>';
        btn.onclick = function() {
            deletePrice(this);
        };
        elem.appendChild(btn);

        prices_list.appendChild(elem);
        $('#select2_for_manufacturer_' + selectCounter).select2({
            theme: 'bootstrap4',
            placeholder: {
                id: '-1', // the value of the option
                text: 'Select an option'
            },

            tags: true,
        });
        $('#select2_for_shop_' + selectCounter).select2({
            theme: 'bootstrap4',
            placeholder: {
                id: '-1', // the value of the option
                text: 'Select an option'
            },
            tags: true,
        });
        selectCounter++;
    }

    const deletePrice = (elem) => elem.parentElement.remove();
</script>

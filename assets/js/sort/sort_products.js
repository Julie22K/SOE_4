let sort_btns=$('.sort-products');
let visible_col_h=$('#h_cellulose'),visible_col_b=$('.b_cellulose');
function sort_products(attr_name,id_btn,short_name) {

    sort_btns.removeClass("active");

    let list, i, switching, b, shouldSwitch;
    list = document.getElementById("myTable");
    switching = true;
    while (switching) {
        switching = false;
        b = list.getElementsByTagName("tr");
        for (i = 0; i < (b.length - 1); i++) {
            shouldSwitch = false;
            if(attr_name==='name_of_product') {
                if (b[i].getAttribute(attr_name)*1 > b[i + 1].getAttribute(attr_name)*1) {
                    shouldSwitch = true;
                    break;
                }
            }
            else {
                if (b[i].getAttribute(attr_name)*1 < b[i + 1].getAttribute(attr_name)*1) {
                    shouldSwitch = true;
                    break;
                }
            }
        }

        if (shouldSwitch) {
            b[i].parentNode.insertBefore(b[i + 1], b[i]);
            switching = true;
        }
    }

    $(id_btn).addClass("active");
    if(short_name!=='')
    {
        visible_col_b.hide();
        visible_col_h.hide();

        visible_col_b= $('.b_'+short_name);
        visible_col_h=$('#h_'+short_name);
        visible_col_b.show();
        visible_col_h.show();
    }

}
$(document).ready(function() {
    sort_products('name_of_product','#sortProductByName');
});
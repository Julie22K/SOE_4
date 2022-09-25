let sort_btns=$('.sort-recipe');
function sort_recipes(attr_name,id_btn) {

    sort_btns.removeClass("active");
    $(id_btn).addClass("active");

    let list, i, switching, b, shouldSwitch;
    list = document.getElementById("listrecipes");

    switching = true;
    while (switching) {
      switching = false;
      b = list.getElementsByClassName("card-dish");

      for (i = 0; i < (b.length - 1); i++) {
        shouldSwitch = false;
        if(attr_name=='name_of_dish') {
            if (b[i].getAttribute(attr_name) > b[i + 1].getAttribute(attr_name)) {
                shouldSwitch = true;
                console.log(1);
                break;

            }
        }
        else{
            if (b[i].getAttribute(attr_name) < b[i + 1].getAttribute(attr_name)) {
                shouldSwitch = true;
                console.log(1);
                break;

            }
        }

      }
      if (shouldSwitch) {
        b[i].parentNode.insertBefore(b[i + 1], b[i]);
        switching = true;
      }
    }

}
$(document).ready(function() {
    sort_recipes('name_of_dish','#sortRecipeByName');
});
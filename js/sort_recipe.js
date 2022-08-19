function sort_recipes_by_name() {
    $("#sortRecipeByName").addClass("active");
    $("#sortRecipeByWht").removeClass("active");
    $("#sortRecipeByPrice").removeClass("active");
    $("#sortRecipeByKKAL").removeClass("active");
    $("#sortRecipeByProtein").removeClass("active");
  $("#sortRecipeByFat").removeClass("active");
  $("#sortRecipeByCarb").removeClass("active");
    var list, i, switching, b, shouldSwitch;
    list = document.getElementById("listrecipes");
    switching = true;
    while (switching) {
      switching = false;
      b = list.getElementsByClassName("card-dish");
      for (i = 0; i < (b.length - 1); i++) {
        shouldSwitch = false;
        if (b[i].getAttribute('name_of_dish') > b[i + 1].getAttribute('name_of_dish')) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        b[i].parentNode.insertBefore(b[i + 1], b[i]);
        switching = true;
      }
    }
}
function sort_recipes_by_weigth() {
    $("#sortRecipeByName").removeClass("active");
    $("#sortRecipeByWht").addClass("active");
    $("#sortRecipeByPrice").removeClass("active");
    $("#sortRecipeByKKAL").removeClass("active");
    $("#sortRecipeByProtein").removeClass("active");
    $("#sortRecipeByFat").removeClass("active");
    $("#sortRecipeByCarb").removeClass("active");
    var list, i, switching, b, shouldSwitch;
    list = document.getElementById("listrecipes");
    switching = true;
    while (switching) {
      switching = false;
      b = list.getElementsByClassName("card-dish");
      for (i = 0; i < (b.length - 1); i++) {
        shouldSwitch = false;
        if (b[i].getAttribute('weight_of_dish') < b[i + 1].getAttribute('weight_of_dish')) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        b[i].parentNode.insertBefore(b[i + 1], b[i]);
        switching = true;
      }
    }
}
 function sort_recipes_by_price() {
  $("#sortRecipeByName").removeClass("active");
  $("#sortRecipeByWht").removeClass("active");
  $("#sortRecipeByPrice").addClass("active");
  $("#sortRecipeByKKAL").removeClass("active");
  $("#sortRecipeByProtein").removeClass("active");
  $("#sortRecipeByFat").removeClass("active");
  $("#sortRecipeByCarb").removeClass("active");
    var list, i, switching, b, shouldSwitch;
    list = document.getElementById("listrecipes");
    switching = true;
    while (switching) {
      switching = false;
      b = list.getElementsByClassName("card-dish");
      for (i = 0; i < (b.length - 1); i++) {
        shouldSwitch = false;
        if (b[i].getAttribute('price_of_dish') < b[i + 1].getAttribute('price_of_dish')) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        b[i].parentNode.insertBefore(b[i + 1], b[i]);
        switching = true;
      }
    }
}
function sort_recipes_by_KKAL() {
  $("#sortRecipeByName").removeClass("active");
  $("#sortRecipeByWht").removeClass("active");
  $("#sortRecipeByPrice").removeClass("active");
  $("#sortRecipeByKKAL").addClass("active");
  $("#sortRecipeByProtein").removeClass("active");
  $("#sortRecipeByFat").removeClass("active");
  $("#sortRecipeByCarb").removeClass("active");
  var list, i, switching, b, shouldSwitch;
  list = document.getElementById("listrecipes");
  switching = true;
  while (switching) {
    switching = false;
    b = list.getElementsByClassName("card-dish");
    for (i = 0; i < (b.length - 1); i++) {
      console.log("name:"+b[i].getAttribute('name_of_dish')+"\nkkal:"+b[i].getAttribute('kkal_of_dish')+"\ncarb:"+b[i].getAttribute('carb_of_dish')+"\nfat:"+b[i].getAttribute('fat_of_dish')+"\nprotein:"+b[i].getAttribute('protein_of_dish'));
      
      shouldSwitch = false;
      if (b[i].getAttribute('kkal_of_dish') < b[i + 1].getAttribute('kkal_of_dish')) {
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      b[i].parentNode.insertBefore(b[i + 1], b[i]);
      switching = true;
    }
  }
}
function sort_recipes_by_carb() {
  $("#sortRecipeByName").removeClass("active");
  $("#sortRecipeByWht").removeClass("active");
  $("#sortRecipeByPrice").removeClass("active");
  $("#sortRecipeByKKAL").removeClass("active");
  $("#sortRecipeByProtein").removeClass("active");
  $("#sortRecipeByFat").removeClass("active");
  $("#sortRecipeByCarb").addClass("active");
  var list, i, switching, b, shouldSwitch;
  list = document.getElementById("listrecipes");
  switching = true;
  while (switching) {
    switching = false;
    b = list.getElementsByClassName("card-dish");
    for (i = 0; i < (b.length - 1); i++) {
      shouldSwitch = false;
      if (b[i].getAttribute('carb_of_dish') < b[i + 1].getAttribute('carb_of_dish')) {
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      b[i].parentNode.insertBefore(b[i + 1], b[i]);
      switching = true;
    }
}
}
function sort_recipes_by_fat() {
  $("#sortRecipeByName").removeClass("active");
  $("#sortRecipeByWht").removeClass("active");
  $("#sortRecipeByPrice").removeClass("active");
  $("#sortRecipeByKKAL").removeClass("active");
  $("#sortRecipeByProtein").removeClass("active");
  $("#sortRecipeByFat").addClass("active");
  $("#sortRecipeByCarb").removeClass("active");
  var list, i, switching, b, shouldSwitch;
  list = document.getElementById("listrecipes");
  switching = true;
  while (switching) {
    switching = false;
    b = list.getElementsByClassName("card-dish");
    for (i = 0; i < (b.length - 1); i++) {
      shouldSwitch = false;
      if (b[i].getAttribute('fat_of_dish') < b[i + 1].getAttribute('fat_of_dish')) {
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      b[i].parentNode.insertBefore(b[i + 1], b[i]);
      switching = true;
    }
}
}
function sort_recipes_by_protein() {
 $("#sortRecipeByName").removeClass("active");
  $("#sortRecipeByWht").removeClass("active");
  $("#sortRecipeByPrice").removeClass("active");
  $("#sortRecipeByKKAL").removeClass("active");
  $("#sortRecipeByProtein").addClass("active");
  $("#sortRecipeByFat").removeClass("active");
  $("#sortRecipeByCarb").removeClass("active");
  var list, i, switching, b, shouldSwitch;
  list = document.getElementById("listrecipes");
  switching = true;
  while (switching) {
    switching = false;
    b = list.getElementsByClassName("card-dish");
    for (i = 0; i < (b.length - 1); i++) {
      shouldSwitch = false;
      if (b[i].getAttribute('protein_of_dish') < b[i + 1].getAttribute('protein_of_dish')) {
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      b[i].parentNode.insertBefore(b[i + 1], b[i]);
      switching = true;
    }
}
}
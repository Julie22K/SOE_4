<script>
    function rebuildTable(menu_id) {
  //get menu datas
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function () {
    const r = this.responseText.split('_');
    rebuildTable2(r);
  }
  xmlhttp.open("GET", "../../vendor/ajax/data/menu_dates.php?id=" + menu_id);
  xmlhttp.send();
}

const days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
const days_short = ['нд', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'];
const mealtimes = ['breakfast', 'snack(1)', 'lunch', 'snack(2)', 'dinner'];
const mealtimes_short = ['сн', 'пер1', 'об', 'пер2', 'веч'];
function rebuildTable2(data) {
  //rebuld table
  let dates = [];
  let current_date = new Date(data[0]);
  const last_date = new Date(data[1]);
  const num_days = (last_date - current_date) / (1000 * 60 * 60 * 24) + 1;
  let i = 0;
  while (i < num_days) {
    let month = current_date.getMonth() * 1 + 1;
    dates.push({
      date: current_date.getFullYear() + "-" + month + "-" + current_date.getDate(),
      day_short: days_short[current_date.getDay()],
      day: days[current_date.getDay()]
    })
    current_date.setDate(current_date.getDate() + 1);
    i++;
  }

  //rebulid thead
  let thead = "";
  thead += "<tr><th></th>"
  for (let i = 0; i < dates.length; i++) {
    thead += "<th title='" + dates[i].date + "'>" + dates[i].day_short + "</th>";
  }
  thead += "</tr>";
  $("#modal_add_recipe_to_menu thead").html(thead);
  //rebuild tbody
  let tbody = "";
  for (let i = 0; i < mealtimes.length; i++) {
    const mealtime = mealtimes[i];
    tbody += `<tr><td>` + mealtimes_short[i] + `</td>`;
    for (let j = 0; j < dates.length; j++) {
      const day = dates[j].day;
      const date = dates[j].date;
      const id = mealtime + "_" + day;
      tbody += `<td class="daymenu">` +
        `<input type="checkbox" name="` + date + `[]" value="` + mealtime + `" class="tgl tgl-flip" id="` + id + `">` +
        `<label class="tgl-btn" for="` + id + `"></label></td>`;
    }
    tbody += `</tr>`;
  }
  $("#modal_add_recipe_to_menu tbody").html(tbody);

}
function modal_add_recipe_to_menu(id) {
  return `<form class="w-full" id="modal_add_recipe_to_menu" action="../../vendor/dish/store_from_recipe.php" method="post">` +
    `<input style="display:none" type="number" value="` +
    id +
    `" id="id" name="id"><div class="col">` +
    `<table class="w-full">` +
    `<thead class="w-full"><tr><th>#</th><th>name</th></tr></thead>` +
    `<tbody class="w-full"><tr><td>1</td><td>Julie</td></tr><tr><td>2</td><td>Alex</td></tr></tbody></table>` +
    `<select onchange="rebuildTable(this.value)" id="menus_list" name="menu"></select>` +
    `<div class="row j-c-be m2">` +
    `
    <?php
        if ($_SESSION['errors']) {
            foreach($_SESSION['errors'] as $error)
            echo '<p class="error"> ' . $error . ' </p>';
        }
        unset($_SESSION['errors']);
    ?>`+
    `<button class="btn m-3" type="submit">Додати</button>` +
    `<button class="btn btn-cancel m-3" type="button" onclick="Modal.close()">Відмінити</button>` +
    `</div></div></form>`;
}

</script>
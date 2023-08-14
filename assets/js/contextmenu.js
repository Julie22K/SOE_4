let context_menu = $(".context-menu-open");
$(document).on("click", function () {
  context_menu.hide();
});
$(document).on("scroll", function () {
  context_menu.hide();
});
function open_context_menu(e, li) {
  context_menu.html(li);
  e.preventDefault();
  context_menu.css({
    top: e.clientY + "px",
    left: e.clientX + "px"
  });

  context_menu.show();
}
function contextMenu(data) {
  let li = "";
  data.forEach((element) => {
    li += contextMenuItem({
      icon: element.icon,
      event: element.event,
      title: element.title
    });
  });
  return "<ul>" + li + "</ul>";
}
function contextMenuItem(data) {
  return (li =
    '<li onclick="' +
    data.event +
    '">' +
    data.icon +
    '<a class="without-line">' +
    data.title +
    "</a></li>");
}

$(".card-recipe").on("contextmenu", (e) => {
  let id = e.currentTarget.id;
  open_context_menu(
    e,
    contextMenu([
      {
        icon: icons.detail,
        event: show_item("recipe", id),
        title: "Переглянути"
      },
      {
        icon: icons.add,
        event: `Modal.add_recipe_to_menu('${id}')`,
        title: "Додати до меню"
      },
      {
        icon: icons.edit,
        event: edit_item("recipe", id),
        title: "Редагувати"
      },
      {
        icon: icons.delete,
        event:
          "Modal.delete_alert('Ви впевненні, що хочете видалити цей рецепт? Всі страви у меню пов`язані з цим рецептом будуть видалені.','recipe','" +
          id +
          "')",
        title: "Видалити"
      }
    ])
  );
});
$(".tr-product").on("contextmenu", (e) => {
  let id = e.currentTarget.id;

  open_context_menu(
    e,
    contextMenu([
      {
        icon: icons.detail,
        event: show_item("product", id),
        title: "Переглянути"
      },
      {
        icon: icons.add,
        event: "location.href='../add/price.php?product=" + id + "'",
        title: "Додати ціну"
      },
      {
        icon: icons.edit,
        event: edit_item("product", id),
        title: "Редагувати"
      },
      {
        icon: icons.delete,
        event:
          "Modal.delete_alert('Ви впевненні, що хочете видалити цей продукт? Всі рецепти з даним продуктом будуть видалені.','product','" +
          id +
          "')",
        title: "Видалити"
      }
    ])
  );
});
$(".card-person").on("contextmenu", (e) => {
  let id = e.currentTarget.id;
  open_context_menu(
    e,
    contextMenu([
      {
        icon: icons.detail,
        event: show_item("person", id),
        title: "Переглянути"
      },
      {
        icon: icons.edit,
        event: edit_item("person", id),
        title: "Редагувати"
      },
      {
        icon: icons.delete,
        event:
          "Modal.delete_alert('Ви впевненні, що хочете видалити дані з цією особою?','person','" +
          id +
          "')",
        title: "Видалити"
      }
    ])
  );
});
$(".card-dish").on("contextmenu", (e) => {
  console.log(e.currentTarget.attributes);
  let day = e.currentTarget.attributes.day.nodeValue;
  let time = e.currentTarget.attributes.time.nodeValue;
  let menu = e.currentTarget.attributes.menu.nodeValue;
  let id = e.currentTarget.id;
  open_context_menu(
    e,
    contextMenu([
      {
        icon: icons.add,
        event:
          "location.href='../add/dish.php?menu=" +
          menu +
          "&date=" +
          day +
          "&time=" +
          time +
          "'",
        title: "Add"
      },
      {
        icon: icons.edit,
        event: edit_item("dish", id),
        title: "Редагувати"
      },
      {
        icon: icons.delete,
        event:
          "Modal.delete_alert('Ви впевненні, що хочете видалити ці страви?','dish','" +
          id +
          "','" +
          menu +
          "')",
        title: "Delete"
      }
    ])
  );
});
$(".card-shop").on("contextmenu", (e) => {
  let id = e.currentTarget.id;
  open_context_menu(
    e,
    contextMenu([
      {
        icon: icons.double,
        event: "",
        title: "Дублювати"
      },
      {
        icon: icons.edit,
        event: edit_item("shop", id),
        title: "Редагувати"
      },
      {
        icon: icons.delete,
        event:
          "Modal.delete_alert('Ви впевненні, що хочете видалити цей магазин? Всі ціна продукти пов'язані з цим магазинм, також будуть видалені.','shop','" +
          id +
          "')",
        title: "Видалити"
      }
    ])
  );
});
$(".card-menu").on("contextmenu", (e) => {
  let id = e.currentTarget.id;
  open_context_menu(
    e,
    contextMenu([
      {
        icon: icons.export,
        event:
          `location.href='C:\\Users\\Dell\\source\\SOE_4\\vendor\\export/word.php?id=` +
          id +
          `'`,
        title: "Експорт в .word"
      },
      {
        icon: icons.export,
        event: `location.href='../../vendor/export/excel.php?id=` + id + `'`,
        title: "Експорт в .excel"
      },
      {
        icon: icons.export,
        event:
          `location.href='C:\\Users\\Dell\\source\\SOE_4\\vendor\\/pfd.php?id=` +
          id +
          `'`,
        title: "Експорт в .pfd"
      },
      {
        icon: icons.menu,
        event: `location.href='../pages/menu.php?id=` + id + `'`,
        title: "Переглянути меню"
      },
      {
        icon: icons.shoplist,
        event: `location.href='../pages/shopping_list.php?id=` + id + `'`,
        title: "Список покупок"
      } /*
      {
        icon: icons.double,
        event: "",
        title: "Дублювати"
      },*/,
      {
        icon: icons.edit,
        event: edit_item("menu", id),
        title: "Редагувати"
      },
      {
        icon: icons.delete,
        event:
          "Modal.delete_alert('Ви впевненні, що хочете видалити це меню?','menu','" +
          id +
          "')",
        title: "Видалити"
      }
    ])
  );
});

function edit_item(item, id) {
  return `location.href='../add/` + item + `.php?id=${id * 1}'`;
}

function show_item(item, id) {
  return `location.href='../show/` + item + `.php?id=${id * 1}'`;
}

$(".close").eq(0).onclick = function () {
  Modal.close(".modal");
};
window.onclick = function (event) {
  if (event.target === $(".modal")) {
    Modal.close(".modal");
  }
};

class Button {
  constructor(title, classes, event) {
    this.title = title;
    this.classes = classes;
    this.event = event;
  }
  build() {
    return '<button class="' + this.classes + '" onclick="' + this.event + '">' + this.title + "</button>";
  }
}

let menus_list = "";
class Modal {
  static close() {
    $(".modal").eq(0).hide();
  }
  static open() {
    $(".modal").eq(0).show();
  }
  static build(title, content, buttons, icon) {
    let modal_header = $(".modal-header");
    let modal_body = $(".modal-body");
    let modal_footer = $(".modal-footer");
    if (title !== "") modal_header.eq(0).html("<h2>" + title + "</h2>");
    if (content !== "") {
      if (icon != "") {
        modal_body.addClass("row j-c-ar");
        modal_body.eq(0).html("<div>" + icon + "</div><div>" + content + "</div>");
      }
      else modal_body.eq(0).html(content);
    }
    if (true) {
      let footer = "";
      buttons.forEach((button) => {
        footer += button.build();
      });
      modal_footer.eq(0).html(footer);
    }
  }
  static simple(title, content, event = "") {
    const buttons = [
      new Button("Додати", "btn m-2", event == "" ? "Modal.close()" : event),
      new Button("Закрити", "btn btn-cancel m-2", "Modal.close()")
    ];
    Modal.build(title, content, buttons, "");
    Modal.open();
  }
  //with ajax
  static with_load_data(title, url, event = "") {
    // console.log("url", url);
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
      const content = this.responseText;
      const buttons = [
        new Button("Додати", "btn m-2", event == "" ? "Modal.close()" : event),
        new Button("Закрити", "btn btn-cancel m-2", "Modal.close()")
      ];
      Modal.build(title, content, buttons, "");
      Modal.open();
    }

    xmlhttp.open("GET", url);
    xmlhttp.send();
  }

  //for delete
  static delete_alert(text, item, id, menu = 0) {
    const title = "Попередження";
    const icon = icons.warning;
    const content = "<p>" + text + "</p>";
    const buttons = [
      new Button(
        "Видалити",
        "btn btn-cancel m-2",
        item != "dish"
          ? Modal.delete_item(item, id * 1)
          : Modal.delete_item(item, id * 1, menu)
      ),
      new Button("Закрити", "btn m-2", "Modal.close()")
    ];
    Modal.build(title, content, buttons, icon);
    Modal.open();
  }
  //others
  static for_form(item, name, default_value) {
    let title = "";
    let body = "";
    const buttons = [
      new Button(
        "Додати",
        "btn m-2",
        "Modal.change_form_data_from_modal('" + item + "','" + name + "')"
      ),
      new Button("Закрити", "btn btn-cancel m-2", "Modal.close()")
    ];
    switch (item) {
      case "image_url":
        title = "Додати зображення";
        body =
          '<div class="m-3 col w-full"><label for="' +
          name +
          '">Посилання на зображення:</label><input type="file" id="' +
          name +
          '" name="' +
          name +
          // '" value="' +
          // default_value +
          '" accept=".png, .jpg, .jpeg" /></div>';
        break;
      case "video_url":
        title = "Додати відео";
        body =
          '<div class="m-3 col w-full"><label for="' +
          name +
          '">Посилання на відео:</label><input type="text" id="' +
          name +
          '" name="' +
          name +
          '" value="' +
          default_value +
          '"></div>';
        break;
      case "description":
        title = "Додати опис";
        body =
          '<div class="m-3 col w-full"><label for="' +
          name +
          '">Опис:</label><textarea id="' +
          name +
          '" name="' +
          name +
          '" value="' +
          default_value +
          '" cols="30" rows="10"></textarea></div>';
        break;
      default:
        break;
    }
    Modal.build(title, body, buttons, "");
    Modal.open();
  }
  static change_form_data_from_modal(item, modal_item) {
    const val = $("#" + modal_item).val();
    $("#" + item).val(val);
    switch (item) {
      case "image_url":
        $("#add_image_url").addClass("invisible");
        $("#add_image_url").css("background-image", `url('${val}')`);
        $("#add_image_url h6").html("Змінити зображення");
        break;
      case "video_url":
        $("#add_video_url").addClass("invisible");
        $("#add_video_url").html(
          `<iframe width="100%" height="160" src="${val}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe><h6>Змінити відео</h6>`
        );
        break;
      case "description":
        $("#add_description").addClass("invisible");
        $("#add_description").html("<p>" + val + "</p><h6>Змінити відео</h6>");
        $("#add_description h6").html("Змінити опис");
        break;
      default:
        break;
    }
    Modal.close();
  }
  static add_recipe_to_menu(id) {
    const title = "Додати рецепт до меню";
    const content = modal_add_recipe_to_menu(id);
    rebuildTable(id);
    Modal.build(title, content, [], "");

    Modal.open();

    if (menus_list == "") {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function () {
        document.getElementById("menus_list").innerHTML = this.responseText;
      }
      xmlhttp.open("GET", "../../vendor/ajax/data/menus_list.php");
      xmlhttp.send();
    }
    else document.getElementById("menus_list").innerHTML = menus_list;

  }
  static delete_item(item, id, menu = 0) {
    if (item == "dish")
      return (
        `location.href='../../vendor/` +
        item +
        `/delete.php?id=${id * 1}&menu=${menu * 1}'`
      );
    else
      return (
        `location.href='../../vendor/` + item + `/delete.php?id=${id * 1}'`
      );
  }
}

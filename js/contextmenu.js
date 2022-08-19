/*$(document).on("contextmenu", function(event) {
    event.preventDefault();
    $(".menu")
      .show()
      .css({
        top: event.pageY,
        left: event.pageX
      });
 });
  $(document).click(function() {
    if ($(".menu").is(":hover") == false) {
      $(".menu").fadeOut("fast");
    };
  });*/


  if (document.addEventListener) {
    document.addEventListener('contextmenu', function(e) {
      alert("You've tried to open context menu"); //here you draw your own menu
      e.preventDefault();
    }, false);
  } else {
    document.attachEvent('oncontextmenu', function() {
      alert("You've tried to open context menu");
      window.event.returnValue = false;
    });
  }
let = contextMenu = $('.context-menu-open');
$('.context-menu').on('contextmenu', function (e) {
    e.preventDefault();
    contextMenu.css({top: e.clientY + 'px', left: e.clientX + 'px' });
    contextMenu.show();
});
$(document).on('click', function () {
    contextMenu.hide();
});
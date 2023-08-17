
function activateCardPart(part_id) {

    //$('.menu-info-card').css('display', 'none');
    //console.log(part_id);
    //if (part_id === 'all_analitic') $("#" + part_id).css('display', 'contents');
    //else $("#" + part_id).css('display', 'block');
    //console.log($("#" + part_id).outerHTML)
    $('#card_analitic').fadeIn('slow');
    $("#" + part_id).fadeIn('slow');
}
activateCardPart('all_analitic');


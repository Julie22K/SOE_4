function activateCardPart(part_id){
    $('.card-part').css('display','none');
    $("#"+part_id).css('display','block');
    //console.log("avtivate:",part_id);
}
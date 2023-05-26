const closeModal=(id)=>$('#'+id).hide();
const openModal=(id)=>$('#'+id).show();
function addContentToModal(header,body,footer) {
    if(header!=='') $('#modal_header').html("<h3>"+header+"</h3>");
    if(body!=='') $('#modal_body').html(body);
    if(footer!=='') $('#modal_footer').html(footer);
}
$(".close")[0].onclick = function() {
    closeModal("myModalChooseDaT");
}
window.onclick = function(event) {
    if (event.target === $('.modal')) {
        closeModal("myModalChooseDaT");
    }
}
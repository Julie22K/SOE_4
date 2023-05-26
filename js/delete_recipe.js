let delete_id=0;

function Delete_recipe(id) {
    delete_id=id;
    openModal('myModalDeleteRecipe');
}
function delete_yes(){
    const xhttp = new XMLHttpRequest();
    try {
        xhttp.open("GET", "vendor/Delete_recipe.php?id="+delete_id);
/*
        console.log("deleted:"+delete_id)*/
        xhttp.send();
        $("#"+delete_id).hide();
        closeModal('myModalDeleteRecipe');

    }
    catch (e) {
        console.log(e)
    }

}
const delete_no=()=>{
   closeModal('myModalDeleteRecipe');
}

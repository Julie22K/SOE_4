<?php
require_once '../config/connect.php';
$post_id = $_GET['id'];
//read recipe
$recipes = mysqli_query($soe, "SELECT * FROM `recipes` WHERE `ID` = '$post_id'");
$recipe = mysqli_fetch_assoc($recipes);
//read ingridients
$ingrs_in_recipe = mysqli_query($soe, "SELECT * FROM ingridients,recipes,products WHERE ingridients.RecipeID='$post_id' AND ingridients.RecipeID=recipes.ID AND products.ID=ingridients.ProductID ;");
$ingrs_in_recipe = mysqli_fetch_all($ingrs_in_recipe);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>
    <link rel="stylesheet" href="CSS/select2.css">
    <title>Add recipe</title>
</head>

<body>
<?php require_once 'blocks/preloader.php' ?>
<div class="container">
    <?php require_once 'blocks/header.php' ?>
    <!-- main -->
    <div class="main">
        <?php require_once 'blocks/topbar.php' ?>
        <div class="page" id="page_add_recipe">
            <form class="form-add" action="vendor/Create_recipe.php" method="post" id="form_add_recipe">
                <div class="row j-c-be">
                    <div class="col" style="width: 300px">
                        <label for="name">Name:</label>
                        <input class="int" type="text" id="name" name="name">
                    </div>
                    <div class="col" style="width: 150px">
                        <label for="type">Type:</label>
                        <select name="type" id="type">
                            <?php
                            foreach ($type_dish as $type) {
                                ?>
                                <option value="<?= $type ?>"><?= $type ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="none-element"><br><input class="int" value="0" name="number_ingredients" type="text" id="number_ingredients"></div>

                </div>
                <div class="row j-c-ar">
                    <div class="add-card" id="add_image" onclick="add_media('input_add_image')">
                        <h6>Click here to add a image</h6>
                    </div>
                    <div class="add-card" id="add_description" onclick="add_media('input_add_description')">
                        <h6>Click here to add a description</h6>
                        <p class="text-center text-description" style="color: black;">

                        </p>
                    </div>
                    <div class="add-card" id="add_video" onclick="add_media('input_add_video')">
                        <h6>Click here to add a video</h6>

                    </div>

                </div>
                <div class="col">
                    <input id="video_value" name="videoURL" type="url" class="none-element int" placeholder="Video url">
                    <input id="image_value" name="image" type="url" class="none-element int" placeholder="Image irl">
                    <textarea id="description_value" name="description" cols="100" rows="50" class="none-element" placeholder="description"></textarea>
                </div>
                <div class="col">
                    <div class="row j-c-be">
                        <button class="btn btn-secondary" onclick="toggleListIngredients()" type="button" id="btn_open_ingredients" disabled>Add ingredients</button>
                        <button class="btn btn-secondary" onclick="toggleListIngredients()" type="button" id="btn_open_list">Add list</button>
                    </div>
                    <h4 class="t-w-0">Ingredients:</h4>
                    <div>
                        <div id="ingredients" class="anti-card">
                            <table id="table_ingredients">
                                <colgroup>
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 40%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 15%;">
                                </colgroup>
                                <tbody id="table_body_ingredients">
                                <tr id="add_ingredient">
                                    <td class="i_id"></td>
                                    <td id="add_i_name" class="name">
                                        <select class="__select2">
                                            <option value="other" default>Choose...</option>
                                            <?php
                                            foreach ($types as $type) {
                                            ?>
                                            <optgroup label="<?= $type?>">
                                                <?php

                                                $ingrs = mysqli_query($soe, "SELECT * FROM `products` WHERE `Type`='$type'");
                                                $ingrs = mysqli_fetch_all($ingrs);
                                                foreach ($ingrs as $ingr) {
                                                    ?>
                                                    <option value="<?= $ingr[1] ?>" price100g="<?= $ingr[3] ?>" productID="<?= $ingr[0] ?>"><?= $ingr[1] ?></option>
                                                    <?php
                                                }
                                                } ?>
                                        </select>
                                    </td>
                                    <td id="add_i_weight" class="weight">
                                        <input class="int" type="number" placeholder="Weight" value="0" min="0">
                                    </td>
                                    <td class="price"></td>
                                    <td class="button-add-i">
                                        <button class="btn btn-secondary btn-small" type="button" onclick="addNewI()">Add</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="list" class="anti-card col" style="display: none;">
                            <textarea name="list" id="list_ingredients" cols="300" rows="100"></textarea>
                            <button class="btn btn-secondary m-4" onclick="addList()">Add list</button>
                        </div>
                    </div>

                </div>
                <div class="row j-c-be">
                    <button class="btn" type="submit">Add recipe</button>
                    <!--<button type="reset">Clean</button>
                    -->
                    <button class="btn btn-cancel" type="button" onclick="location.href='recipes.php'">Cancel</button>
                </div>
            </form>
        </div>
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <div class="modal-content p-0" id=modal-content>
                <div class="modal-header">
                    <h3 id="modal_header_text">Add media</h3>
                </div>
                <div class="modal-body">
                    <div class="modal-content-content" id="input_add_video"><input class="int" id="v" name="v" type="url" placeholder="Enter a URL of video"></div>
                    <div class="modal-content-content" id="input_add_image"><input class="int" id="i" name="i" type="url" placeholder="Enter a URL of image"></div>
                    <div class="modal-content-content" id="input_add_description"><textarea id="d" name="d" cols="100" rows="50"></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" onclick="closeModalAndAdd()">Add</button>
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.__select2').select2();
    });

    //modalwindow
    let modal = $("#myModal");
    let span = $(".close")[0];
    function add_media(id) {
        modal.show();
        console.log(id)
        $(".modal-content-content").hide("slow");
        $("#"+id).show("slow");

        if(id==='input_add_image') $('#modal_header_text').html('Add image');
        else if(id==='input_add_video') $('#modal_header_text').html('Add video');
        else $('#modal_header_text').html('Add description');
    }
    function changeMedia(elem,id) {
        if(elem==='video'||elem==='image') $('#'+elem+"_value").val($("#"+id+" input").val());
        else $('#'+elem+"_value").val($("#"+id+" textarea").val());

    }
    const closeModal=()=>modal.hide();
    function closeModalAndAdd() {
        if($('#v').val()!=='') {
            $('#video_value').val($('#v').val());
            changeVideo($('#v').val());
            $('#v').val('');
        }
        else if($('#i').val()!==''){
            $('#image_value').val($('#i').val());
            changeImage($('#i').val());
            $('#i').val('');
        }
        else {
            $('#description_value').val($('#d').val());
            changeDescription($('#d').val());
            $('#d').val('');
        }
        closeModal();
    }
    span.onclick = function() {
        closeModal('');
    }
    window.onclick = function(event) {
        if (event.target === modal) {
            closeModal();
        }
    }

    function changeVideo(video_){
        let li='<iframe width="100%" height="100%" src="'+video_.replace('youtu.be/','/www.youtube.com/embed/')+'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
        $('#add_video').html(li)
    }
    function changeImage(image_){
        $('#add_image').css('background-image','url(\''+image_+'\')')
        $('#add_image h6').text('Click here to change a image');
        $('#add_image').addClass(' invisible');
    }
    function changeDescription(description_){
        $('#add_description p').text(description_)
        $('#add_description h6').text('Click here to change a description');
        $('#add_description').addClass(' invisible');
    }
</script>
<script>
    class ingredient{
        constructor(id,counter,name,weight,price_100g) {
            this.id=id;
            this.name=name;
            this.weight=weight;
            this.counter=counter;
            this.price=weight*price_100g/100;
            this.price_100g=price_100g;
        }
    }
    counter_=1;
    function toggleListIngredients() {
        $("#ingredients").toggle('slow');
        $("#list").toggle('slow');
        $("#btn_open_list").prop('disabled', function(i, v) { return !v; });
        $("#btn_open_ingredients").prop('disabled', function(i, v) { return !v; });
    }
    let list_=[];
    fillList();
    function addNewI(){
        let data_select=$('#add_i_name .__select2 option:selected');
        let data_weight=$('#add_i_weight input');
        console.log(data_select)
        let id=data_select.attr("productID");
        let name= data_select.val();
        let weight=data_weight.val()*1;
        let price100g=data_select.attr("price100g");

        if (weight === 0) alert('Оберіть інгрідієнт та його вагу!');
        else {
            list_.push(new ingredient(id*1,++counter_,name,weight*1,price100g*1));


            console.log(list_);
            data_select.value="";
            data_weight.value="";

            fillList();
        }

    }
    function fillList(){
        let li='';

        let add_i=$("#add_ingredient").html();
        list_.forEach((ingredient)=>{

            li+='<tr class="new-i" id="new_i_'+ingredient.counter+'"> ' +
                '<td class="i_id">' +
                '<input class="int" type="number" name="new_i_'+ingredient.counter+'_id" value="'+ingredient.id+'">' +
                '<td class="name"><input class="int" type="text" name="new_i_'+ingredient.counter+'_name" value="'+ingredient.name+'" disabled></td> ' +
                '<td class="weight"><input class="int" type="number" name="new_i_'+ingredient.counter+'_weight" value="'+ingredient.weight+'">g</td> ' +
                '<td class="price"><input class="int" type="number" name="new_i_'+ingredient.counter+'_price" value="'+ingredient.price+'">$</td> ' +
                '<td class="button-add-i"><span onclick="deleteI(\'new_i_'+ingredient.counter+'\')"><ion-icon name="close-outline"></ion-icon></span></td> ' +
                '</tr>';
        });
        if(list_.length<=10) $("#table_body_ingredients").html(li+'<tr id="add_ingredient">'+add_i+'</tr>');
        else $("#table_body_ingredients").html(li);
        $("#number_ingredients").val(list_.length);
    }
    function deleteI(id){

        id=id.replace("new_i_",'')*1;

        list_=list_.filter(i=>i.id!==id);

        console.log(id)
        fillList();
    }
</script>

<!--
    Яйце - 300г
    Молоко - 300мл
    Сіль - 2г
    Масло вершкове - 20г-->

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="js/navbar.js"></script>
<script src="js/setting.js"></script>
<script src="js/color.js"></script>
</body>

</html>
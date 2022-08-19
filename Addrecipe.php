<?php require_once 'config/connect.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>
    <link rel="stylesheet" href="CSS/forms.css" type="text/css" />
    <link rel="stylesheet" href="CSS/modal.css" type="text/css" />
    <title>Add recipe</title>
</head>

<body>
    <?php require_once 'blocks/preloader.php' ?>
    <div class="container">
        <?php require_once 'blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php' ?>
            <div class="page" id="AddRecipe">
                <form action="vendor/Create_recipe.php" method="post">
                    <div class="form-addrecipe">
                        <div class="form-part form-head row">
                            <p id="inputName">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name">
                            </p>
                            <p id="inputType">
                                <label for="type">Type:</label>
                                <select name="type" id="type">
                                    <?php
                                    foreach ($typedish as $type) {
                                    ?>
                                        <option value="<?= $type ?>"><?= $type ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </p>
                            <div class="hiden-element"><br><input value="0" name="numofingrs" type="text" id="numOfIngrs"></div>

                        </div>
                        <div class="form-part form-media row">
                            <button onclick="add_image_to_recipe()" class="addBox" type="button">
                                Click here to add a image
                            </button>
                            <button onclick="add_description_to_recipe()" class="addBox" type="button">
                                Click here to add a recipe
                            </button>
                            <button onclick="add_video_to_recipe()" class="addBox" type="button">
                                Click here to add a video
                            </button>
                            <div id="MyModal" class="modal">
                                <span class="close">&times;</span>
                                <!-- Modal content -->
                                <div class="modal-content" id=modal-content>
                                    <div id="AddVideo"><input name="videoURL" type="url" placeholder="Enter a URL of video"></div>
                                    <div id="AddImage"><input name="image" type="url" placeholder="Enter a URL of image"></div>
                                    <div id="AddDescription"><textarea name="description" cols="100" rows="50"></textarea></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-part form-listOfIngrs">

                            <table id="listingr"></table>
                            <table>
                                <tr>
                                    <th><select class="__select2" id="nmingr">
                                            <?php
                                            foreach ($types as $type) {
                                            ?>
                                                <optgroup label="<?= $type ?>">
                                                    <?php

                                                    $ingrs = mysqli_query($soe, "SELECT * FROM `products` WHERE `Type`='$type'");
                                                    $ingrs = mysqli_fetch_all($ingrs);
                                                    foreach ($ingrs as $ingr) {
                                                    ?>
                                                        <option value="<?= $ingr[1] ?>" price100g="<?= $ingr[3] ?>" productID="<?= $ingr[0] ?>"><?= $ingr[1] ?></option>
                                                <?php }
                                                } ?>
                                        </select></th>
                                    <th><input id="ingrweight" type="text" placeholder="Weight"></th>
                                    <th><button type="button" onclick="addingritem()">Add</button></th>

                                </tr>
                            </table>
                        </div>
                        <div class="form-part form-btns row">
                            <button type="submit">Add recipe</button>
                            <button type="reset">Clean</button>
                            <button onclick="location.href='recipes.php'">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        let counter = 0;
        let counter_id = 0;
        let listingrs = [];

        function addingritem() {

            let wht = $('#ingrweight').val();

            if (wht == 0) alert('Введіть вагу!');
            else {
                let nm = $('#nmingr :selected').val();
                let price100g = $('#nmingr :selected').attr("price100g");
                let ProductID = $('#nmingr :selected').attr("productID");

                listingrs.push({
                    ID: counter_id,
                    Name: nm,
                    Price100g: price100g,
                    Weight: wht,
                    ProductID: ProductID
                }); //check
                counter_id++;
                PrintListIngrs(); //check
                $("#numOfIngrs").val(listingrs.length); //check
                //$('#nmingr :selected').val() = "";
                $('#ingrweight').val("");
            }
        }

        function deleteIngridient(id_ingr) {
            id_ingr = id_ingr.slice(10);
            console.log(id_ingr);
            listingrs = listingrs.filter(elem => elem.ID != id_ingr);
            PrintListIngrs();
        }

        function PrintListIngrs() {
            let li = "";
            let counter = 0;
            listingrs.forEach(item => {
                //console.log("ingridient\nName:" + item.Name + "ID:" + item.ID)
                li = li + '<tr id="ingridient' + item.ID + '" price100g="' + item.Price100g + '">';
                li += '<th><input type="text" class="hiden ingrname" value="' + item.Name + '"></th>'; //name
                li += '<th><input type="number" name="weight' + counter + '" onchange="changeinrweight(\'ingridient' + counter + '\')" class="hiden ingrwht" value="' + item.Weight + '">g</th>'; //weight
                li += '<th><input type="text" name="" class="hiden ingrprice" value="' + (item.Weight * item.Price100g) / 100 + '">грн</th>'; //price
                li += '<th><input type="number" name="product' + counter + '" class="hiden-element" value="' + item.ProductID + '" ></th>'; //productID
                li += '<th onclick="deleteIngridient(\'ingridient' + item.ID + '\')" class="delete">X</th></tr>';

                counter++
            });


            $('#listingr').html(li);
        }

        function changeinrweight(tr_id) {
            let new_weigth = $('#' + tr_id + " .ingrwht").val();
            let price100g = $('#' + tr_id).attr("price100g");

            console.log(tr_id + "\nprice100g=" + price100g + "\nNew weigth:" + new_weigth + "\nNew price:" + (new_weigth * price100g) / 100);
            $("#" + tr_id + " .ingrprice").val((new_weigth * price100g) / 100);

        }
        $(document).ready(function() {
            $('.__select2').select2();
        });

        //modalwindow
        let modal = $("#myModal");
        let span = $(".close")[0];

        //AddVideo
        function add_video_to_recipe() {
            $("#MyModal").css("display", "block");
            $("#AddVideo").css("display", "block");
            $("#AddImage").css("display", "none");
            $("#AddDescription").css("display", "none");
        }
        //add image
        function add_image_to_recipe() {
            $("#MyModal").css("display", "block");
            $("#AddVideo").css("display", "none");
            $("#AddImage").css("display", "block");
            $("#AddDescription").css("display", "none");
        }
        //add recipe(description)
        function add_description_to_recipe() {
            $("#MyModal").css("display", "block");
            $("#AddVideo").css("display", "none");
            $("#AddImage").css("display", "none");
            $("#AddDescription").css("display", "block");
        }
        span.onclick = function() {
            $("#MyModal").css("display", "none");
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                $("#MyModal").css("display", "none");
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>
</body>

</html>
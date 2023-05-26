<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php';
    require_once 'config/connect.php';
    ?>
    <link rel="stylesheet" href="CSS/forms.css" type="text/css" />
    <title>Add products</title>
</head>

<body>
    <?php require_once 'blocks/preloader.php' ?>
    <div class="container">
        <?php require_once 'blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php' ?>
            <div class="page" id="page_add_product">
                <form class="form-add" id="form_add_product" action="vendor/Create_product.php" method="post">
                   <div class="row j-c-be">
                       <div class="col">
                           <Label for="nm">Name:</Label>
                           <input class="int" type="text" name="name" id="nm">
                       </div>
                       <div class="col">
                           <Label for="tp">Type:</Label>
                           <select class="slt" id="tp" name="type">
                               <option selected disabled>Choose a group</option>
                               <?php
                               foreach ($types as $type) {
                                   ?>
                                   <option value="<?= $type ?>"><?= $type ?></option>
                                   <?php
                               }
                               ?>
                           </select>
                       </div>
                       <div class="col">
                           <Label for="prc">Price:</Label>
                           <input class="int" id="prc" type="number" min='0' step="0.01" name="price" placeholder="Price of 100g">
                       </div>
                           <!-- <input type="text" name="image" placeholder="url"> -->

                   </div>

                    <div class="col" id="form_add_product_vits_and_mins">
                        <div class="row j-c-be">
                            <input class="int" type="number" step="0.001" name="kcal" placeholder="Kcal">
                            <input class="int" type="number" step="0.001" name="carb" placeholder="Carb">
                            <input class="int" type="number" step="0.001" name="fat" placeholder="Fat">
                            <input class="int" type="number" step="0.001" name="protein" placeholder="Protein">
                            <input class="int" type="number" step="0.001" name="water" placeholder="Water">
                            <input class="int" type="number" step="0.001" name="cellulose" placeholder="Cellulose">

                        </div>
                        <div class="row j-c-be">
                            <input class="int" type="number" step="0.001" name="vitA" placeholder="A">
                            <input class="int" type="number" step="0.001" name="vitE" placeholder="E">
                            <input class="int" type="number" step="0.001" name="vitK" placeholder="K">
                            <input class="int" type="number" step="0.001" name="vitD" placeholder="D">
                            <input class="int" type="number" step="0.001" name="vitC" placeholder="C">
                            <input class="int" type="number" step="0.001" name="om3" placeholder="Omega-3">

                        </div>
                        <div class="row j-c-be">
                            <input class="int" type="number" step="0.001" name="om6" placeholder="Omega-6">
                            <input class="int" type="number" step="0.001" name="vitB1" placeholder="B1">
                            <input class="int" type="number" step="0.001" name="vitB2" placeholder="B2">
                            <input class="int" type="number" step="0.001" name="vitB5" placeholder="B5">
                            <input class="int" type="number" step="0.001" name="vitB6" placeholder="B6">
                            <input class="int" type="number" step="0.001" name="vitB8" placeholder="B8">

                        </div>
                        <div class="row j-c-be">
                            <input class="int" type="number" step="0.001" name="vitB9" placeholder="B9">
                            <input class="int" type="number" step="0.001" name="vitB12" placeholder="B12">
                            <input class="int" type="number" step="0.001" name="minMg" placeholder="Mg">
                            <input class="int" type="number" step="0.001" name="minNa" placeholder="Na">
                            <input class="int" type="number" step="0.001" name="minCl" placeholder="Cl">
                            <input class="int" type="number" step="0.001" name="minCa" placeholder="Ca">

                        </div>
                        <div class="row j-c-be">
                            <input class="int" type="number" step="0.001" name="minK" placeholder="K">
                            <input class="int" type="number" step="0.001" name="minS" placeholder="S">
                            <input class="int" type="number" step="0.001" name="minP" placeholder="P">
                            <input class="int" type="number" step="0.001" name="minCu" placeholder="Cu">
                            <input class="int" type="number" step="0.001" name="minI" placeholder="I">
                            <input class="int" type="number" step="0.001" name="minCr" placeholder="Cr">

                        </div>
                    </div>
                    <div class="row j-c-be">
                        <button class="btn" type="submit">Add product</button>
                        <button class="btn btn-cancel"  type="button" onclick="location.href='products.php'">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>




    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>
</body>

</html>
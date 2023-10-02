<?php

require 'C:\Users\Julie\source\SOE_4\public\blocks/pre_head.php';

use App\Models\Product;
use App\Models\RecipeCategory;

?>
<!DOCTYPE html <html lang="en">

<head>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/head.php' ?>
    <title>Додати рецепт</title>
</head>

<body oncontextmenu="return false;">
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/preloader.php' ?>
    <div class="container">
        <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/header.php' ?>
        <div class="main">
            <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/topbar.php' ?>
            <div class="page" id="page_add_recipe">
                <h1>Додавання рецепту:</h1>
                <form action="../../vendor/recipe/store.php" method="post" id="form_add_recipe">
                    <div class="col">
                        <div class="row j-c-be">
                            <div class="m-3 w-third">
                                <label for="title">Назва:</label>
                                <input type="text" id="title" name="title">
                            </div>
                            <div class="m-3 w-third">
                                <Label for="recipe_category">Категорія:</Label>
                                <select class="select2 m-2" name="recipe_category" id="recipe_category">
                                    <?php
                                    $categories = RecipeCategory::all();
                                    foreach ($categories as $category) {
                                    ?>
                                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="m-3 w-third">
                                <label for="portions">Кількість порцій:</label>
                                <input type="number" step="1" min="0" id="portions" name="portions">
                            </div>
                        </div>
                        <div class="row j-c-ar">
                            <div class="add-card" id="add_image_url" onclick="Modal.for_form('image_url','modal_add_image_url','')">
                                <h6>Додати зображення</h6>
                            </div>
                            <div class="add-card" id="add_description" onclick="Modal.for_form('description','modal_add_description','')">
                                <h6>Додати опис</h6>
                                <p class="text-center text-description" style="color: black;"></p>
                            </div>
                            <div class="add-card" id="add_video_url" onclick="Modal.for_form('video_url','modal_add_video_url','')">
                                <h6>Додати відео</h6>

                            </div>
                        </div>
                        <div class="col">
                            <input id="video_url" name="video_url" type="url" class="none-element int">
                            <input id="image_url" name="image_url" type="url" class="none-element int">
                            <textarea id="description" name="description" cols="100" rows="50" class="none-element"></textarea>
                        </div>
                        <div class="col">
                            <div class="col w-full" id="list_ingredients">
                                <div class="row j-c-ar">
                                    <h6>Продукт</h6>
                                    <h6>Вага</h6>
                                    <h6>Ціна</h6>
                                    <h6></h6>
                                </div>
                                <div class="row j-c-ar a-items-baseline">
                                    <select class="m-2 select2-add w-half" name="products[]" id="products">
                                        <option value="" default>Оберіть продукт</option>
                                        <?php
                                        $products = Product::all();
                                        foreach ($products as $product) {
                                        ?>
                                            <option value="<?= $product->id ?>"><?= $product->title ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <input class="m-2" type="number" placeholder="Введіть вагу" name="weights[]" onchange="changePrice(this)">
                                    <input class="m-2" type="number" name="prices[]" readonly>
                                    <button type="button" class="m-2 btn" onclick="deleteIngredient(this)">X</button>
                                </div>
                            </div>
                            <button type="button" class="m-2 btn" onclick="addIngredient(this)">Додати інгрідієнт</button>
                        </div>
                        <?php
                            if ($_SESSION['errors']) {
                                foreach($_SESSION['errors'] as $error)
                                    echo '<p class="error"> ' . $error . ' </p>';
                            }
                            unset($_SESSION['errors']);
                        ?>
                        <div class="row j-c-be">
                            <button type="submit" class="btn btn-save">Додати</button>
                            <button type="button" class="btn btn-cancel" onclick="location.href='../pages/recipes.php'">Повернутись</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        function addIngredient(list) {
            const list_ingredients = document.getElementById('list_ingredients');

            var elem = document.createElement('div');
            elem.className = 'row j-c-ar a-items-baseline';

            var selectProduct = document.createElement('select');
            selectProduct.className = 'm-2 select2-add';
            selectProduct.name = 'products[]';
            <?php
            $products = Product::all();
            foreach ($products as $product) {
            ?>
                var product = document.createElement('option');
                product.value = '<?= $product->id ?>';
                product.text = '<?= $product->title ?>';
                selectProduct.appendChild(product);
            <?php
            }
            ?>
            elem.appendChild(selectProduct);




            var inputWeight = document.createElement('input');
            inputWeight.className = 'm-2';
            inputWeight.type = 'number';
            inputWeight.name = 'weights[]';
            elem.appendChild(inputWeight);

            var inputPrice = document.createElement('input');
            inputPrice.className = 'm-2';
            inputPrice.type = 'number';
            inputPrice.name = 'prices[]';
            elem.appendChild(inputPrice);




            var btn = document.createElement('button');
            btn.className = 'btn m-2';
            btn.textContent = 'X';
            btn.onclick = function() {
                deleteIngredient(this);
            };
            elem.appendChild(btn);

            list_ingredients.appendChild(elem);

        }

        function changePrice(elem) {

        }

        const deleteIngredient = (elem) => elem.parentElement.remove();
    </script>
    <?php require 'C:\Users\Julie\source\SOE_4\public\blocks/fotter.php'; ?>
</body>

</html>
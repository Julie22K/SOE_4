</div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: "Оберіть...",
        });
        $('.select2-add').select2({
            theme: 'bootstrap4',
            placeholder: "Оберіть...",
            tags: true
        });

    });
</script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="../../assets/js/data/icons.js"></script>
<script src="../../assets/js/data/modal_add_recipe_to_menu.js"></script>
<script src="../../assets/js/purePajinate.es5.min.js"></script>
<script src="../../assets/js/navbar.js"></script>
<script src="../../assets/js/contextmenu.js"></script>
<script src="../../assets/js/setting.js"></script>
<script src="../../assets/js/modal.js"></script>

<div class="context-menu-open" id="contextmenuperson"></div>
<?php
if($page_title=="Список покупок"){
    require_once '../blocks/scripts/shopping_list.php'; 
} 
else if($page_title=="Редагування режиму харчування"){
    require_once '../blocks/scripts/meal_times.php'; 
}
else if($page_title=="Menu of week"){
    require_once '../blocks/scripts/menu.php'; 
}
else if($page_title=="Продукти"){
    require_once '../blocks/scripts/products.php'; 
}
else if($page_title=="Рецепти"){
    require_once '../blocks/scripts/recipes.php'; 
}




unset($_SESSION['message']);
?>
</body>

</html>
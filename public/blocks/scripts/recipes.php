<!-- <script>
    changeViewSide('filterSort', 'recipes-header-side', 'recipes_header')

    function changeViewSide(id, c, p_id) {
        $('.' + c).css('display', 'none');
        $("#" + id).css('display', 'block');
        //$('#'+p_id).css('max-height',parseInt(document.getElementById(id).height)+30+"px");
    }

    function recipesListView(num, btn_id) {
        let container = $("#recipes_list");
        container.removeClass('grid-2');
        container.removeClass('grid-3');
        container.removeClass('grid-4');
        container.addClass('grid-' + num);
        $('#columns_nums .btn-setting').removeClass('active');
        $('#' + btn_id).addClass('active')
    }
</script>
<script>
    //modal

    function openModalChooseDaT(id) {
        openModal('myModalChooseDaT');
        $('#recipe_id_chooseDaT').val(id);
    }

    function ReadDescriptionRecipe(recipe_id) {
        openModal('myModalMedia');
        $('#myModalMedia h3').text('Description of the recipe:')
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            $('#modal_content').html('<p>' + this.responseText + '</p>');
        }
        xmlhttp.open("GET", "php_ajax/get_description_recipe.php?id=" + recipe_id);
        xmlhttp.send();

    }

    function WatchVideoRecipe(recipe_id) {
        openModal('myModalMedia');
        $('#myModalMedia h3').text('Video-recipe:')
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            $('#modal_content').html(this.responseText);
        }
        xmlhttp.open("GET", "php_ajax/get_video_recipe.php?id=" + recipe_id);
        xmlhttp.send();
    }
</script>
<script>
    //pagination
    document.onreadystatechange = function() {
        if (document.readyState === "complete") {

            var example_3 = new purePajinate({
                containerSelector: '#recipes_list',
                itemSelector: '.card-recipe',
                navigationSelector: '.page_navigation',
                wrapAround: true,
                pageLinksToDisplay: 10,
                itemsPerPage: 11,
                startPage: 0
            });
        }
    };
    //elems on page:11(+'add'),23,23+12,23+12*2
</script><script src="../../assets/js/dishes.js"></script>
<script src="../../assets/js/sort/sort_recipe.js"></script>
<script src="../../assets/js/delete_recipe.js"></script> -->
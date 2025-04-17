<script>
    $('.horizontal .progress-fill span').each(function() {
        var percent = $(this).html();
        $(this).parent().css('width', percent);
    });
</script>
<script src="../../assets/js/shoplist.js"></script>
<script src="../../assets/js/sort_recipe.js"></script>
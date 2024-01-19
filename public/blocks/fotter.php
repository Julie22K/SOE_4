<?php require_once '../modals/example.php'; ?>
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
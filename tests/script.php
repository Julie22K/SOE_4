<script>
    function hideBlock(e) {
        console.log("тест");
        console.log("e", e);
        console.log("elems", e.parentElement.getElementsByClassName('block'));
        
        for (let i = 0; i < e.parentElement.getElementsByClassName('block').length; i++) {
            e.parentElement.getElementsByClassName('block')[i].classList.toggle('show');
            
        }
        // e.parentElement.classList.toggle('show');
    }
</script>
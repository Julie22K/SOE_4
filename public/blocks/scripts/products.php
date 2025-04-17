<script>
    let category_for_filtering=null;
    let category_for_sorting=null;
    let searching_word=null;

    let current_page=0;
    function SetURL(){
        let url="/public/pages/products.php?page="+current_page;

        if(category_for_filtering!=null) url+="&filter="+category_for_filtering;
        if(category_for_sorting!=null) url+="&sort="+category_for_sorting;
        if(searching_word!=null) url+="&search="+searching_word;
        console.log('url:',url);
        location.href=url;
    }
    function ChangePage(page_value) {
        console.log('current page:',page_value)
        current_page=page_value;
        SetURL();
    }
    function Filter(field) {
        category_for_filtering=field;
        SetURL();
    }
    function Sort(field) {
        category_for_sorting=field;
        SetURL();
    }
    function Search(value){
        searching_word=value;
        SetURL();
    }


function OpenDropDown(div_id){
    console.log(document.getElementById(div_id));
    document.getElementById(div_id).classList.toggle('show');
}
function BeforeChangePage(e,isOver){
    if(isOver){
        e.classList.add("current_page");
        document.getElementById("pagination_current_page").classList.remove("current_page");
    }
    else{
        e.classList.remove("current_page");
        document.getElementById("pagination_current_page").classList.add("current_page");
    }
}
</script>
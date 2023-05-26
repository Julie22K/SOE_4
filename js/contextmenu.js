let contextMenu = $('.context-menu-open');
$('.card-recipe').on('contextmenu', e=> {
    let contextMenuCardDish =$('#context_menu_recipe_card');
    let id_recipe=e.currentTarget.id;
    let li='<ul><li onclick="openModalChooseDaT(\''+id_recipe+'\')"><ion-icon name="apps-outline"></ion-icon>Add to menu</li>\n' +
       /* '            <li onclick="WatchVideoRecipe(\''+id_recipe+'\')">\n' +
        '                <ion-icon name="videocam-outline"></ion-icon><a class="without-line">Video</a>\n' +
        '            </li>\n' +*/
        '            <li onclick="ReadDescriptionRecipe(\''+id_recipe+'\')">\n' +
        '                <ion-icon name="document-text-outline"></ion-icon><a class="without-line">Description</a>\n' +
        '            </li>\n' +
        '            <li onclick="location.href=\'update/Update_recipe.php?id='+id_recipe+'\'">\n' +
        '                <ion-icon name="create-outline"></ion-icon><a class="without-line">Edit</a>\n' +
        '            </li>\n' +
        '            <li onclick="Delete_recipe(\''+id_recipe+'\')">\n' +
        '                <ion-icon name="close-outline"></ion-icon><a class="without-line">Delete</a>\n' +
        '            </li>\n' +
        '        </ul>';
    contextMenuCardDish.html(li);

    e.preventDefault();
    contextMenuCardDish.css({
        top: e.clientY + 'px',
        left: e.clientX + 'px'
    });

    contextMenuCardDish.show();
});

$(document).on('click', function() {
    contextMenu.hide();
});
$(document).on('scroll', function() {
    contextMenu.hide();
});
$('.tr-product').on('contextmenu', e=> {
    let contextMenuProductTr =$('#contextmenuproducttr');
    let id=e.currentTarget.id;
    let li='<ul>\n' +
        '            <li onclick="location.href=\'update/Update_product.php?id='+id+'\'">\n' +
        '                <ion-icon name="create-outline"></ion-icon><a class="without-line">Edit</a>\n' +
        '            </li>\n' +
        '            <li onclick="location.href=\'vendor/Delete_product.php?id='+id+'\'">\n' +
        '                <ion-icon name="close-outline"></ion-icon><a class="without-line">Delete</a>\n' +
        '            </li>\n' +
        '        </ul>';
    contextMenuProductTr.html(li);
    e.preventDefault();
    contextMenuProductTr.css({
        top: e.clientY + 'px',
        left: e.clientX + 'px'
    });

    contextMenuProductTr.show();
});
$('.card-prof').on('contextmenu', e=> {
    let contextMenuPerson =$('#contextmenuperson');
    let id=e.currentTarget.id;
    let li='<ul>\n' +
        '            <li onclick="location.href=\'update/Update_person.php?id='+id+'\'">\n' +
        '                <ion-icon name="create-outline"></ion-icon><a class="without-line">Edit</a>\n' +
        '            </li>\n' +
        '            <li onclick="location.href=\'vendor/Delete_person.php?id='+id+'\'">\n' +
        '                <ion-icon name="close-outline"></ion-icon><a class="without-line">Delete</a>\n' +
        '            </li>\n' +
        '        </ul>';
    contextMenuPerson.html(li);

    e.preventDefault();
    contextMenuPerson.css({
        top: e.clientY + 'px',
        left: e.clientX + 'px'
    });

    contextMenuPerson.show();
});

$('.card-dish').on('contextmenu', e=> {
    let contextMenuMenuCell =$('#contextmenumenucell');
    let day=e.currentTarget.attributes.day.nodeValue;
    let time=e.currentTarget.attributes.time.nodeValue;
    let number=e.currentTarget.attributes.number_dishes.nodeValue;
    let id=e.currentTarget.id;

    let change_='<li onclick="change_dishes_list(\''+day+'\',\''+time+'\','+id+')">\n' +
        '<ion-icon name="create-outline"></ion-icon><a class="without-line">Change</a></li>';
    if(number<2)  change_='';
    console.log(e.currentTarget.attributes.day.nodeValue);
    let li='<ul>\n' +
        '            <li onclick="add_dish_from_menu(\''+day+'\',\''+time+'\')">\n' +
        '                <ion-icon name="add-circle-outline"></ion-icon><a class="without-line">Add</a>\n' +
        '            </li>\n' +
                        change_ +
        '            <li onclick="location.href=\'vendor/Delete_menucell.php?day='+day+'&time='+time+'&id='+id+'\'">\n' +
        '                <ion-icon name="close-outline"></ion-icon><a class="without-line">Delete</a>\n' +
        '            </li>\n' +
        '        </ul>';
    contextMenuMenuCell.html(li);

    e.preventDefault();
    contextMenuMenuCell.css({
        top: e.clientY + 'px',
        left: e.clientX + 'px'
    });

    contextMenuMenuCell.show();
});
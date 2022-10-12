let contextMenu = $('.context-menu-open');
        $('.card-dish').on('contextmenu', e=> {
            let contextMenuCardDish =$('#contextmenurecipecard');
            let id_recipe=e.currentTarget.id;
            let li='<ul><li onclick="chooseday('+id_recipe+')"><ion-icon name="apps-outline"></ion-icon>Add to menu</li>\n' +
                '            <li>\n' +
                '                <ion-icon name="create-outline"></ion-icon><a class="without-line" href="update/Update_recipe.php?id='+id_recipe+'">Edit</a>\n' +
                '            </li>\n' +
                '            <li>\n' +
                '                <ion-icon name="close-outline"></ion-icon><a class="without-line" href="vendor/Delete_recipe.php?id='+id_recipe+'">Delete</a>\n' +
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
        '            <li>\n' +
        '                <ion-icon name="create-outline"></ion-icon><a class="without-line" href="update/Update_product.php?id='+id+'">Edit</a>\n' +
        '            </li>\n' +
        '            <li>\n' +
        '                <ion-icon name="close-outline"></ion-icon><a class="without-line" href="vendor/Delete_product.php?id='+id+'">Delete</a>\n' +
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
        '            <li>\n' +
        '                <ion-icon name="create-outline"></ion-icon><a class="without-line" href="update/Update_person.php?id='+id+'">Edit</a>\n' +
        '            </li>\n' +
        '            <li>\n' +
        '                <ion-icon name="close-outline"></ion-icon><a class="without-line" href="vendor/Delete_person.php?id='+id+'">Delete</a>\n' +
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

$('.card-menu').on('contextmenu', e=> {
    let contextMenuMenuCell =$('#contextmenumenucell');
    let day=e.currentTarget.attributes.day.nodeValue;
    let time=e.currentTarget.attributes.time.nodeValue;
    let id=e.currentTarget.id;
    console.log(e.currentTarget.attributes.day.nodeValue);
    let li='<ul>\n' +
        '            <li>\n' +
        '                <ion-icon name="close-outline"></ion-icon><a class="without-line" href="vendor/Delete_menucell.php?day='+day+'&time='+time+'&id='+id+'">Delete</a>\n' +
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
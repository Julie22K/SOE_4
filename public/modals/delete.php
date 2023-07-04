<div id="myModalDeleteRecipe" class="modal">
    <div class="modal-content" id=modal-content>
        <div class="modal-header">
            <h3>Delete recipe:</h3>
        </div>
        <div class="modal-body row">
            <ion-icon name="warning-outline" class="icon-clr-warning icon-size-big"></ion-icon>
            <p>Are you sure you want to delete the recipe? All dishes associated with it will also be deleted.</p>
        </div>
        <div class="modal-footer">
            <button class="btn" onclick="delete_yes()">Yes</button>
            <button class="btn btn-cancel" onclick="delete_no()">No</button>
        </div>

    </div>
</div>
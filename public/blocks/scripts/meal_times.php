<script>
    let data = [];

    function getList() {
        return new Promise((resolve, reject) => {
            $.get("/vendor/ajax/get_meal_time_data.php", function(data) {
                // console.log("data", JSON.parse(data));
                resolve(JSON.parse(data));
            });

        });
    }

    async function loadList(params) {
        data = await getList();
        await fillList();
    }

    loadList();

    function changePriorities(id, new_value) {

        //
        let current_element_index = null;
        let finded_element_index = null;
        data.forEach(function(element, index) {

            if (element.id == id) {
                current_element_id = element.id ;
                current_element_index = data.findIndex(a => a.id == current_element_id);
            }
            if (element.priority == new_value) {
                finded_element_id = element.id ;
                finded_element_index = data.findIndex(a => a.id == finded_element_id);
            }
        });;
        
        console.log("finded_element_index", finded_element_index);
        console.log("current_element_index", current_element_index)

        if (current_element_index != null && finded_element_index != null) {
            console.log("data", data);
            let old_value = data[current_element_index].priority;
            data[current_element_index].priority = new_value;
            data[finded_element_index].priority = old_value;
        } else if (current_element_index != null && finded_element_index == null) {
            data[current_element_index].priority = new_value;
        }

        //sort
        data.sort((a, b) => a.priority - b.priority);

        fillList();
    }

    function addMealTime() {
        let priority = $("#add input")[0].value;
        let text = $("#add input")[1].value;
        // let is_used = $("#add input")[2].value;
        console.log(text, priority);
        data.push({
            id: null,
            name: text,
            priority: priority,
            is_used: true,
        });
        fillList();

    }


    function fillList() {
        const table = data.map((item) => {
            const checked = item.is_used == 1 ? 'checked' : '';
            
            return '<tr id="' + item.id + '">' +
                '<td><input class="fake" style="width:60px;" onchange="changePriorities(' + item.id + ',this.value)" type="number" step="1" min="1" name="priorities[]" value="' + item.priority + '"></td>' +
                '<td><input class="fake" style="width:150px;" type="text" name="names[]" value="' + item.name + '"></td>' +
                '<td><input class="fake" type="checkbox" name="is_uses_'+item.id+'" ' + checked + '></td>' +
                '</tr>';
        });
        const addBtn = '<tr id="add">' +
            '<td><input id="number" onchange="changePriorities()" type="number" step="1" min="1" name="number" style="height:30px;" value="' + (data.length + 1) + '"></td>' +
            '<td><input id="name" type="text" name="name" style="height:30px;" value=""></td>' +
            '<td><button type="button" class="btn btn-cancel btn-small w-full" onclick="addMealTime()">Додати</button></td>' +
            '</tr>';
        const ids = data.map((item) => {
            return '<input type="text" name="ids[]" value="' + item.id + '">';
        });
        $('#ids').html(ids);
        $('#myTable').html(table + addBtn);
    }
</script>
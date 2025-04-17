<?php
require '../blocks/pre_head.php';

if (isset($_SERVER['HTTP_REFERER'])) $_SESSION['PREV_PAGE']= $_SERVER['HTTP_REFERER'];

$id = 0;
$is_add_page = true;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $is_add_page = false;
}
$page_title = $is_add_page ? "Додати особу" : "Редагувати особу";

require '../blocks/head.php';

use App\Models\Person;

$person = Person::find($id);

?>

<div class="page">
    <h1><?= $page_title ?></h1>
    <form action="../../vendor/person/<?= $is_add_page ? 'store.php' : 'update.php?id=' . $id ?>" method="post">
        <div class="col">
            <div class="row j-c-be">
                <div class="w-half form-control">
                    <label for="name">Ім'я:</label>
                    <input type="text" name="name" id="name" <?= $is_add_page ? '' : 'value="' . $person->name . '"' ?>>
                </div>
                <div class="w-half form-control">
                    <legend>Стать:</legend>
                    <div class="row j-c-ev a-items-center">
                        <div class="m-2">
                            <input type="radio" id="woman" checked value="woman" name="gender" <?= $is_add_page ? '' : ($person->gender == 'woman' ? 'checked' : '') ?>>
                            <label for="woman">Жінка</label>
                        </div>

                        <div class="m-2">
                            <input type="radio" id="man" value="man" name="gender" <?= $is_add_page ? '' : ($person->gender == 'man' ? 'checked' : '') ?>>
                            <label for="man">Чоловік</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row j-c-be">
                <div class="w-half form-control">
                    <label for="date_of_birth">Дата народження:</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" <?= $is_add_page ? 'value="2000-01-01"' : 'value="' . $person->date_of_birth . '"' ?>>
                </div>
                <div class="w-half form-control">
                    <label for="activity">Рівень активності:</label>
                    <select name="activity" id="activity">
                        <option value="" default>Оберіть рівень активнсті</option>
                        <option value="1.2" <?= $is_add_page ? '' : ($person->activity == '1.2' ? 'selected' : '') ?>>1.2 (Мінімальна активність)</option>
                        <option value="1.4" <?= $is_add_page ? '' : ($person->activity == '1.4' ? 'selected' : '') ?>>1.4 (Помірна активність)</option>
                        <option value="1.55" <?= $is_add_page ? '' : ($person->activity == '1.55' ? 'selected' : '') ?>>1.55 (Середня активність)</option>
                        <option value="1.7" <?= $is_add_page ? '' : ($person->activity == '1.7' ? 'selected' : '') ?>>1.7 (Висока активність)</option>
                        <option value="1.9" <?= $is_add_page ? '' : ($person->activity == '1.9' ? 'selected' : '') ?>>1.9 (Дуже висока активність)</option>
                    </select>
                </div>
            </div>
            <div class="row j-c-be">
                <div class="w-half form-control">
                    <label for="height">Зріст:</label>
                    <input type="number" name="height" id="height" placeholder="Введіть зріст у сантиметрах" step="1" min="156" <?= $is_add_page ? '' : 'value="' . $person->height . '"' ?>>
                </div>
                <div class="w-half form-control">
                    <label for="weigth">Вага:</label>
                    <input type="number" name="weight" id="weight" placeholder="Введіть вагу у кілограмах" step="1" min="45" <?= $is_add_page ? '' : 'value="' . $person->weight . '"' ?>>
                </div>
            </div>
            <?php
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $error)
                    echo '<p class="error"> ' . $error . ' </p>';
            }
            unset($_SESSION['errors']);
            ?>
            <div class="row j-c-be button-row">
                <button type="submit" class="btn btn-save"><?= $is_add_page ? "Додати" : "Зберегти" ?></button>
                <button type="button" class="btn btn-cancel" onclick="location.href='../pages/persons.php'">Повернутись</button>
            </div>
            <!--for add user_id-->
            <input type="number" class="hiden-element" name="user_id" id="name" value="<?= $_SESSION['user']['id'] ?>">

        </div>
    </form>
</div>
<script>
    const act = document.querySelector('#act');
    const output = document.querySelector('.price-output');

    output.textContent = act.value;

    act.addEventListener('input', function() {
        output.textContent = act.value;
    });
</script>

<?php require '../blocks/fotter.php'; ?>
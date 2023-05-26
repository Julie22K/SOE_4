<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>
    <link rel="stylesheet" href="CSS/forms.css" type="text/css" />
    <title>Add persons</title>
</head>

<body>
    <?php require_once 'blocks/preloader.php' ?>
    <div class="container">
        <?php require_once 'blocks/header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require_once 'blocks/topbar.php' ?>
            <div class="page" id="page_add_person">
                <form class="form-add col" id="form_add_person" action="vendor/Create_person.php" method="post">

                        <div class="row a-items-center j-c-be">
                            <div>
                                <Label for="nm">Name:</Label>
                                <input class="int" type="text" name="name" id="nm">
                            </div>
                            <div class="row" id="radio_sex">
                                <input class="int" type="radio" value="woman" name="sex" id="option-1" checked>
                                <input class="int" type="radio" value="man" name="sex" id="option-2">
                                <label for="option-1" class="option option-1">
                                    <div class="dot"></div>
                                    <span>Woman</span>
                                </label>
                                <label for="option-2" class="option option-2">
                                    <div class="dot"></div>
                                    <span>Man</span>
                                </label>
                            </div>
                        </div>
                        <div class="row a-items-center j-c-be">

                            <div>
                                <Label for="hg">Height:</Label>
                                <input class="int" type="number" min="150" max="210" step="0.5" name="height" value="160" id="hg">
                            </div>
                            <div>
                                <Label for="wg">Weight:</Label>
                                <input class="int" type="number" min="40" max="100" step="0.5" name="weight" value="60" id="wg">
                            </div>
                            <div>
                                <Label for="dt">Date of birth:</Label>
                                <input class="int" type="date" name="date" id="dt">
                            </div>
                        </div>
                        <Label for="act">Activity:</Label>
                        <input class="int" type="range" min="1.2" max="1.9" step="0.1" name="activity" id="act">
                        <output class="price-output" for="act"></output>

                    <div class="row j-c-be">
                        <button type="submit" class="btn">Add person</button>
                        <!--<button type="reset" class="btn">Clean</button>
                        -->
                        <button type="button" class="btn btn-cancel" onclick="location.href='persons.php'">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        const act = document.querySelector('#act');
        const output = document.querySelector('.price-output');

        output.textContent = act.value;

        act.addEventListener('input', function() {
            output.textContent = act.value;
        });
    </script>



    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/setting.js"></script>
    <script src="js/color.js"></script>
</body>

</html>
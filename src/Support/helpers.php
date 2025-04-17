<?php
if (!function_exists('dd')) {

    /**
     * Dump the passed variables and end the script.
     *
     * @return void
     */
    function dd()
    {

        $args = func_get_args();

        call_user_func_array('dump', $args);

        die(1);
    }
}
function pre($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function vardump($array)
{
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}
function loadImage($file)
{
    $target_dir = "../../load_data/images/products/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            return "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            return "File is not an image.";
            $uploadOk = 0;
        }
    }
    if (file_exists($target_file)) {
        return "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($file["size"] > 500000) {
        return "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($uploadOk != 0) {
        if (move_uploaded_file($file["tmp_name"], $target_file)) return true;
    }
}
function returnToPrevPage(): void
{
    if (isset($_SESSION['PREV_PAGE'])) {
        $prev_page = $_SESSION['PREV_PAGE'];
        unset($_SESSION['PREV_PAGE']);
        header('Location: ' . $prev_page);
    }
}
function returnToReallyPrevPage(): void
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

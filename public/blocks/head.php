<?php


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use App\Data;
use App\Models\MealTime;
use App\Models\Product;
use App\Migrations\Migration;
//FIXME:
$migration = new Migration();
$migration->run();
$migration->runForUser($_SESSION['user']['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head_links.php' ?>
    <title><?= $page_title ?></title>
</head>

<body oncontextmenu="return false;">

<?php require_once '../modals/example.php'; ?>
<?php require 'preloader.php' ?>

    <div class="container">
        <?php require 'header.php' ?>
        <!-- main -->
        <div class="main">
            <?php require 'topbar.php' ?>
<?php

namespace App;
require_once 'C:\Users\Julie\source\SOE_4/vendor/autoload.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /');
}
?>

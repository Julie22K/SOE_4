<?php

namespace App;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'C:\Users\Laptopchik\source\soe4\SOE_4\vendor\autoload.php';

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}
?>
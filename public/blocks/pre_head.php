<?php
require 'C:\Users\Julie\source\SOE_4\config/connect.php';
require 'C:\Users\Julie\source\SOE_4\config/data.php';
require 'C:\Users\Julie\source\SOE_4\config/migrations_data.php';
require 'C:\Users\Julie\source\SOE_4\config/migrations.php';
require 'C:\Users\Julie\source\SOE_4\config/models.php';
require 'C:\Users\Julie\source\SOE_4\config/validate.php';

session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>

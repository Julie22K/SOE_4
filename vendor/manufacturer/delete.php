<?php

use App\Models\Manufacturer;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

$id = $_GET['id'];

Manufacturer::find($id)->delete();




header('Location: ../../public/pages/manufacturers.php');

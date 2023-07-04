<?php

use App\Models\Person;

require 'C:\Users\Dell\source\SOE_4\public/blocks/pre_head.php';


$id = $_GET['id'];

Person::find($id)->delete();



header('Location: ../../public/pages/persons.php');

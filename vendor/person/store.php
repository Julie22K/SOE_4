<?php

use App\Models\Person;


require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

use App\Validate;
Validate::Validate("person",[
    "name"=>$_POST['name'],
    "gender" => $_POST['gender'],
    "date_of_birth" => $_POST['date_of_birth'],
    "weight" => $_POST['weight'],
    "height" => $_POST['height'],
    "activity" => $_POST['activity'],
]);

$new_person = new Person($data);
$new_person->create();

header('Location: ../../public/pages/persons.php');

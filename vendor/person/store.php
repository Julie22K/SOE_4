<?php

use App\Models\Person;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';


use App\Validate\Validate;
$data=Validate::Validate("person",[
    "name"=>$_POST['name'],
    "gender" => $_POST['gender'],
    "date_of_birth" => $_POST['date_of_birth'],
    "weight" => $_POST['weight'],
    "height" => $_POST['height'],
    "activity" => $_POST['activity'],
    "user_id" => $_POST['user_id'],
]);
//in validate func second parameter is just $_POST
$new_person = new Person($data['name'],$data['gender'],$data['date_of_birth'],$data['weight'],$data['height'],$data['activity'],$data['user_id']);
$new_person->create();

header('Location: ../../public/pages/persons.php');

<?php

require_once '../../public/blocks/pre_head.php';

use App\Models\Person;
use App\Validate\Validate;

$data_for_person=Validate::Validate("person",[
    "name"=>$_POST['name'],
    "gender" => $_POST['gender'],
    "date_of_birth" => $_POST['date_of_birth'],
    "weight" => $_POST['weight'],
    "height" => $_POST['height'],
    "activity" => $_POST['activity'],
]);
$data_for_person['user_id']=$_SESSION['user']['id'];

$person = new Person($data_for_person);
$person->CalcNorms(); //important for person

$res=$person->create();

if (is_array($res)) {
    returnToPrevPage();
}
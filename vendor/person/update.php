<?php

require_once '../../public/blocks/pre_head.php';

use App\Models\Person;
use App\Validate\Validate;

$id=$_GET['id'];
$data_for_update_person=Validate::Validate("person",[
    'name' => $_POST['name'],
    'gender' => $_POST['gender'],
    'date_of_birth' => $_POST['date_of_birth'],
    'height' => $_POST['height'],
    'weight' => $_POST['weight'],
    'activity' => $_POST['activity'],
]);

$person = Person::find($id);
$person->name=$_POST['name'];
$person->gender=$_POST['gender'];
$person->date_of_birth=$_POST['date_of_birth'];
$person->height=$_POST['height'];
$person->weight=$_POST['weight'];
$person->activity=$_POST['activity'];
$person->CalcNorms(); 

$person->update($id);

header('Location: ../../public/pages/persons.php');

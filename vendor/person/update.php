<?php
require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

use App\Models\Person;

$id=$_GET['id'];
$data=[
    'name' => $_POST['name'],
    'gender' => $_POST['gender'],
    'date_of_birth' => $_POST['date_of_birth'],
    'height' => $_POST['height'],
    'weight' => $_POST['weight'],
    'activity' => $_POST['activity'],
];
$res=Person::update($id,$data);

header('Location: ../../public/pages/persons.php');

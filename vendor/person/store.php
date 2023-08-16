<?php

use App\Models\Person;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

$name = $_POST['name'];
$gender = $_POST['gender'];
$date_of_birth = $_POST['date_of_birth'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$activity = $_POST['activity'];

var_dump($_POST);
$new_person = new Person($name, $gender, $date_of_birth, $weight, $height, $activity);
$new_person->create();

var_dump($new_person);

header('Location: ../../public/pages/persons.php');

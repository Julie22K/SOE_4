<?php

require_once '../../public/blocks/pre_head.php';

use App\Models\Person;

$id = $_GET['id'];

Person::find($id)->delete($id);

header('Location: ../../public/pages/persons.php');

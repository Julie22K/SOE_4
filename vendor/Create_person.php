<?php
require_once '../config/connect.php';
require_once '../config/nutr.php';

$name = $_POST['name'];
$sex = $_POST['sex'];
$date = $_POST['date'];
$age = calculate_age($date);
$height = $_POST['height'];
$weight = $_POST['weight'];
$activity = $_POST['activity'];

$kkal = round(GetKkal($sex, $activity, $weight, $height, $age), 2);
$carb = round(GetCarb($kkal), 2);
$fat = round(GetFat($kkal), 2);
$protein = round(GetProtein($kkal), 2);
$cellulose = round(GetCellulose($kkal), 2);
$water = round(GetWater($weight), 2);
//норми можуть бути не правильними
$vitA = 900;
$vitE = 15;
$vitK = 100;
$vitD = 10;
$vitC = 70;
//Физиологическая потребность для взрослых составляют 8 - 10 г/сутки омега-6 жирных кислот
// и 0,8 - 1,6 г/сутки омега-3 жирных кислот, или 5 - 8% от калорийности суточного рациона для омега-6 и 1 - 2% 
//от калорийности суточного рациона для омега-3.
$om3 = round(0.06 * $kkal, 2);
$om6 = round(0.015 * $kkal, 2);
$vitB1 = 1.3;
$vitB2 = 1.5;
$vitB5 = 4;
$vitB6 = 1.6;
$vitB8 = 1000; //mg
$vitB9 = 400;
$vitB12 = 3;
$minMg = 400;
$minNa = 1300;
$minCl = 2300;
$minCa = 1200;
$minK = 2500;
$minS = 4;
$minP = 1200;
$minCu = 1000;
$minI = 150;
$minCr = 35;
//vitk - vitK(змінити мал. літеру на велику скрізь)
mysqli_query($soe, "INSERT INTO `persons`(`Name`, `Sex`, `age`, `Date_of_birth`, `activity`, `Weight`, `Height`, 
 `kkal`, `carb`, `fat`, `protein`, `cellulose`, `water`,
 `vitA`, `vitE`, `vitK`, `vitD`, `vitC`, `om3`, `om6`, 
`vitB1`, `vitB2`, `vitB5`, `vitB6`, `vitB8`, `vitB9`, `vitB12`, `minMg`, `minNa`, `minCl`, `micCa`, 
`minK`, `minS`, `minP`, `minCu`, `minI`, `minCr`) 
 VALUES ('$name','$sex','$age','$date','$activity','$weight','$height',
 '$kkal','$carb','$fat','$protein','$cellulose','$water' ,
 '$vitA','$vitE','$vitK','$vitD','$vitC','$om3','$om6','$vitB1','$vitB2','$vitB5','$vitB6','$vitB8','$vitB9','$vitB12',
 '$minMg','$minNa','$minCl','$minCa','$minK','$minS','$minP','$minCu','$minI','$minCr')");


header('Location: ../persons.php');

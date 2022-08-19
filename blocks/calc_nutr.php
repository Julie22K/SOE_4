<?php
function CalcPercent($value, $Norm)
{
    $res = round(($value * 100) / $Norm, 1);
    return $res <= 100 ? $res : 100;
}
$persons = mysqli_query($soe, "SELECT * FROM `persons`");
$persons = mysqli_fetch_all($persons);

$Norm_fin_on_week = 1000;

$Norm_kkal = 0;
$Norm_carb = 0;
$Norm_fat = 0;
$Norm_protein = 0;
$Norm_cellulose = 0;
$Norm_water = 0;

$Norm_vitA = 0;
$Norm_vitE = 0;
$Norm_vitK = 0;
$Norm_vitD = 0;
$Norm_vitC = 0;
$Norm_Om3 = 0;
$Norm_Om6 = 0;
$Norm_vitB1 = 0;
$Norm_vitB2 = 0;
$Norm_vitB5 = 0;
$Norm_vitB6 = 0;
$Norm_vitB8 = 0;
$Norm_vitB9 = 0;
$Norm_vitB12 = 0;

$Norm_minMg = 0;
$Norm_minNa = 0;
$Norm_minCl = 0;
$Norm_minCa = 0;
$Norm_minK = 0;
$Norm_minS = 0;
$Norm_minP = 0;
$Norm_minCu = 0;
$Norm_minI = 0;
$Norm_minCr = 0;
//порахувати норми
foreach ($persons as $person) {
    $Norm_kkal += $person[8];
    $Norm_carb += $person[9];
    $Norm_fat += $person[10];
    $Norm_protein += $person[11];
    $Norm_cellulose += $person[12];
    $Norm_water += $person[13];
    $Norm_vitA += $person[14];
    $Norm_vitE += $person[15];
    $Norm_vitK += $person[16];
    $Norm_vitD += $person[17];
    $Norm_vitC += $person[18];
    $Norm_Om3 += $person[19];
    $Norm_Om6 += $person[20];
    $Norm_vitB1 += $person[21];
    $Norm_vitB2 += $person[22];
    $Norm_vitB5 += $person[23];
    $Norm_vitB6 += $person[24];
    $Norm_vitB8 += $person[25];
    $Norm_vitB9 += $person[26];
    $Norm_vitB12 += $person[27];

    $Norm_minMg += $person[28];
    $Norm_minNa += $person[29];
    $Norm_minCl += $person[30];
    $Norm_minCa += $person[31];
    $Norm_minK += $person[32];
    $Norm_minS += $person[33];
    $Norm_minP += $person[34];
    $Norm_minCu += $person[35];
    $Norm_minI += $person[36];
    $Norm_minCr += $person[37];
}
$Norm_kkal * 7;
$Norm_carb * 7;
$Norm_fat * 7;
$Norm_protein * 7;
$Norm_cellulose * 7;
$Norm_water * 7;

$Norm_vitA * 7;
$Norm_vitE * 7;
$Norm_vitK * 7;
$Norm_vitD * 7;
$Norm_vitC * 7;
$Norm_Om3 * 7;
$Norm_Om6 * 7;
$Norm_vitB1 * 7;
$Norm_vitB2 * 7;
$Norm_vitB5 * 7;
$Norm_vitB6 * 7;
$Norm_vitB8 * 7;
$Norm_vitB9 * 7;
$Norm_vitB12 * 7;

$Norm_minMg * 7;
$Norm_minNa * 7;
$Norm_minCl * 7;
$Norm_minCa * 7;
$Norm_minK * 7;
$Norm_minS * 7;
$Norm_minP * 7;
$Norm_minCu * 7;
$Norm_minI * 7;
$Norm_minCr * 7;
//порахувати кількість
$ingrs = mysqli_query($soe, "SELECT * FROM dishes,recipes,ingridients,products WHERE dishes.RecipeID=recipes.ID AND ingridients.RecipeID=recipes.ID AND ingridients.ProductID=products.ID;");
$ingrs = mysqli_fetch_all($ingrs);
$valuekkal = 0;
$valuecarb = 0;
$valuefat = 0;
$valueprotein = 0;
$valuecellulose = 0;
$valuewater = 0;
$valuevitA = 0;
$valuevitE = 0;
$valuevitK = 0;
$valuevitD = 0;
$valuevitC = 0;
$valueOm3 = 0;
$valueOm6 = 0;
$valuevitB1 = 0;
$valuevitB2 = 0;
$valuevitB5 = 0;
$valuevitB6 = 0;
$valuevitB8 = 0;
$valuevitB9 = 0;
$valuevitB12 = 0;

$valueminMg = 0;
$valueminNa = 0;
$valueminCl = 0;
$valueminCa = 0;
$valueminK = 0;
$valueminS = 0;
$valueminP = 0;
$valueminCu = 0;
$valueminI = 0;
$valueminCr = 0;
$valuefin = 0;
foreach ($ingrs as $ingr) {
    $valuefin += $ingr[17];
    $valuekkal += $ingr[19];
    $valuecarb += $ingr[20];
    $valuefat += $ingr[21];
    $valueprotein += $ingr[22];
    $valuewater += $ingr[24];
    $valuecellulose += $ingr[23];

    $valuevitA += $ingr[25];
    $valuevitE += $ingr[26];
    $valuevitK += $ingr[27];
    $valuevitD += $ingr[28];
    $valuevitC += $ingr[29];
    $valueOm3 += $ingr[30];
    $valueOm6 += $ingr[31];
    $valuevitB1 += $ingr[32];
    $valuevitB2 += $ingr[33];
    $valuevitB5 += $ingr[34];
    $valuevitB6 += $ingr[35];

    $valuevitB8 += $ingr[36];

    $valuevitB9 += $ingr[37];
    $valuevitB12 += $ingr[38];
    $valueminMg += $ingr[39];
    $valueminNa += $ingr[40];
    $valueminCl += $ingr[41];
    $valueminCa += $ingr[42];
    $valueminK += $ingr[43];
    $valueminS += $ingr[44];
    $valueminP += $ingr[45];
    $valueminCu += $ingr[46];
    $valueminI += $ingr[47];
    $valueminCr += $ingr[48];
}



//порахувати проценти
$percentfin = CalcPercent($valuefin, $Norm_fin_on_week);

$percentcarb = CalcPercent($valuecarb, $Norm_carb);
$percentfat = CalcPercent($valuefat, $Norm_fat);
$percentprotein = CalcPercent($valueprotein, $Norm_protein);

$percentwater = CalcPercent($valuewater, $Norm_water);
$percentcellulose = CalcPercent($valuecellulose, $Norm_cellulose);
$percentvitA = CalcPercent($valuevitA, $Norm_vitA);
$percentvitE = CalcPercent($valuevitE, $Norm_vitE);
$percentvitK = CalcPercent($valuevitK, $Norm_vitK);
$percentvitD = CalcPercent($valuevitD, $Norm_vitD);
$percentvitC = CalcPercent($valuevitC, $Norm_vitC);
$percentOm3 = CalcPercent($valueOm3, $Norm_Om3);
$percentOm6 = CalcPercent($valueOm6, $Norm_Om6);

$percentvitB1 = CalcPercent($valuevitB1, $Norm_vitB1);
$percentvitB2 = CalcPercent($valuevitB2, $Norm_vitB2);
$percentvitB5 = CalcPercent($valuevitB5, $Norm_vitB5);
$percentvitB6 = CalcPercent($valuevitB6, $Norm_vitB6);
$percentvitB8 = CalcPercent($valuevitB8, $Norm_vitB8);

$percentvitB9 = CalcPercent($valuevitB9, $Norm_vitB9);
$percentvitB12 = CalcPercent($valuevitB12, $Norm_vitB12);

$percentminMg = CalcPercent($valueminMg, $Norm_minMg);
$percentminNa = CalcPercent($valueminNa, $Norm_minNa);
$percentminCl = CalcPercent($valueminCl, $Norm_minCl);
$percentminCa = CalcPercent($valueminCa, $Norm_minCa);
$percentminK = CalcPercent($valueminK, $Norm_minK);
$percentminS = CalcPercent($valueminS, $Norm_minS);
$percentminP = CalcPercent($valueminP, $Norm_minP);
$percentminCu = CalcPercent($valueminCu, $Norm_minCu);
$percentminI = CalcPercent($valueminI, $Norm_minI);
$percentminCr = CalcPercent($valueminCr, $Norm_minCr);


$percentvit = round(($percentvitA + $percentvitE + $percentvitE + $percentvitD + $percentvitC + $percentOm3 + $percentOm6 + $percentvitB1 + $percentvitB2 + $percentvitB5 + $percentvitB6 + $percentvitB8 + $percentvitB9 + $percentvitB12) / 14, 1);
$percentmin = round(($percentminMg + $percentminNa + $percentminCl + $percentminCa + $percentminK + $percentminS + $percentminP + $percentminCu + $percentminI + $percentminCr) / 10, 1);

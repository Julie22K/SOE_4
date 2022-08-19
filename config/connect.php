<?php
$par1_ip = "127.0.0.1";
$par2_name = 'root';
$par3_p = '';

// $par1_ip = "s1.ho.ua";
// $par2_name = 'soe';
// $par3_p = 'dtqbr0TByO';
$par4_dp = 'soe';
$soe = mysqli_connect($par1_ip, $par2_name, $par3_p, $par4_dp);

mysqli_set_charset($soe, 'utf8');
if ($soe == false) {
    echo "error";
}
$typedish = array("all", "sup", "salad", "meat", "snack", "breakfast", "sandwich", "drink", "desert", "poridje", "puncakes", "sweets", "sauce", "paste", "baking", "pudding", "others");
$types = array('vegetables', 'fruits', 'fish', 'green', 'berries', 'legumes', 'milk', 'meat', 'eggs', 'mushrooms', 'cereals',  'spices', 'baking', 'tea', 'dried fruits', 'nuts', 'seed', 'oil');
$times = array('breakfast', 'snack(1)', 'lunch', 'snack(2)', 'dinner');
$days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');



//warning code
// $products = mysqli_query($soe, "SELECT * FROM `products`");
// $products = mysqli_fetch_all($products);
// foreach ($products as $product) {
//     $word = $product[1];
//     $word[0] = mb_strtoupper($word[0]);
//     $ID = $product[0];
//     mysqli_query($soe, "UPDATE `products` SET `Name`='$word'WHERE `ID`='$ID'");
// }

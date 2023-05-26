<?php
$par1_ip = "127.0.0.1";
$par2_name = 'root';
$par3_p = '';

/*$par1_ip = "s1.ho.ua";
$par2_name = 'soe';
$par3_p = 'dtqbr0TByO';*/
$par4_dp = 'soe';
$soe = mysqli_connect($par1_ip, $par2_name, $par3_p, $par4_dp);

mysqli_set_charset($soe, 'utf8');
if (!$soe) {
    echo "error";
}
$type_dish = array("sup", "salad", "meat","fish", "snack", "breakfast", "sandwich", "drink", "dessert", "poridje", "puncakes", "sweets", "sauce", "paste", "baking", "pudding", "others");
$types = array('vegetables', 'fruits', 'fish', 'green', 'berries', 'legumes', 'milk', 'meat', 'eggs', 'mushrooms', 'cereals',  'spices', 'baking', 'tea', 'dried fruits', 'nuts', 'seed', 'oil');
$times = array('Breakfast', 'Snack(1)', 'Lunch', 'Snack(2)', 'Dinner');
$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
//warning code
// $products = mysqli_query($soe, "SELECT * FROM `products`");
// $products = mysqli_fetch_all($products);
// foreach ($products as $product) {
//     $word = $product[1];
//     $word[0] = mb_strtoupper($word[0]);
//     $ID = $product[0];
//     mysqli_query($soe, "UPDATE `products` SET `Name`='$word'WHERE `ID`='$ID'");
// }
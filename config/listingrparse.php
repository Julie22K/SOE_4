<?php
$par1_ip = "127.0.0.1";
$par2_name = 'root';
$par3_p = '';
$par4_dp = 'soe';
$soe = mysqli_connect($par1_ip, $par2_name, $par3_p, $par4_dp);

if($soe->connect_error) {
    exit('Could not connect');
}

$str=$_GET['name'];
$weight=$_GET['weight'];
$counter=$_GET['counter'];
$array=explode(" ",$str);
$res="";
if(count($array)>1)
{
    for($i=0;$i<count($array);$i++)
    {
        $res=$res . "name LIKE '%" . $array[$i] . "%'";
        if($i!=count($array)-1) $res=$res . " OR ";
    }
}
else $res="name LIKE '%" . $array[0] . "%'";
$products = mysqli_query($soe,"SELECT `id`,`type`,`name`,`price100g` FROM products WHERE " . $res);

$icon = "";
$name = "";
$price =0;
$Price100g=0;
$productID=null;
if ($products) {

    if ($products->num_rows === 0) {
        $icon = 'bi bi-x-circle-fill color-red';
        $name = $str;
    } else {


        if ($products->num_rows === 1) {

            $products = mysqli_fetch_assoc($products);
            //print_r($products);
            $icon = 'bi bi-check-circle-fill color-green';
            $productID=$products['id'];
            $name = $products['name'];
            $Price100g=$products['price100g'];
            if (is_numeric($weight) && is_numeric($products['price100g'])) {
                $price = ($weight * $products['price100g']) / 100;
            } else {
                $price = "";
            }

        } else {
            $products = mysqli_fetch_all($products);
            $icon = 'bi bi-exclamation-circle-fill color-orange';
            $name=$str;

            //$name='<select weight="' . $weight . '" name="' . $counter . '" id="ingridient' . $counter . '" onchange="ChangeSelectData(ingridient' . $counter . ')">';

            /*foreach ($products as $product) {
                $name=$name . '<option price="' . ($weight * $product[3]) / 100 . '" value="' . $product[2] . '">' . $product[2] . '</option>';
            }*/
            //$name=$name . '</select>';
        }
    }

}
/*echo "<tr>";
echo "<td> <i class=\"" . $icon . "\"></i></td>";
echo "<td>" . $name . "</td>";
echo "<td>" . $weight . "</td>";
echo "<td>" . $price . " грн</td>";
echo "</tr>";*/


echo '<tr id="ingridient' . $counter . '" price100g="' . $Price100g . '">';
echo "<td> <i class=\"" . $icon . "\"></i></td>";
echo '<th><input type="text" class="hiden ingrname" value="' . $name . '"></th>'; //name
echo '<th><input type="number" name="weight' . $counter . '" onchange="changeinrweight(\'ingridient' . $counter . '\')" class="hiden ingrwht" value="' . $weight . '">g</th>'; //weight
echo '<th><input type="text" name="" class="hiden ingrprice" value="' . $price . '">грн</th>'; //price
echo '<th><input type="number" name="product' . $counter . '" class="hiden-element" value="' . $productID . '" ></th>'; //productID
echo '<th onclick="deleteIngridient(\'ingridient' . $counter . '\')" class="delete">X</th>';
echo '</tr>';

?>

<?php

namespace App;

use mysqli;
use App\DB;

$type_dish = array("sup", "salad", "meat", "fish", "snack", "breakfast", "sandwich", "drink", "dessert", "poridje", "puncakes", "sweets", "sauce", "paste", "baking", "pudding", "others");
$types = array('vegetables', 'fruits', 'fish', 'green', 'berries', 'legumes', 'milk', 'meat', 'eggs', 'mushrooms', 'cereals', 'spices', 'baking', 'tea', 'dried fruits', 'nuts', 'seed', 'oil');
$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

class Data
{
    public static $info_data = ['kcal', 'fat', 'carb', 'protein', 'water', 'cellulose', 'vitA', 'vitE', 'vitK', 'vitD', 'vitC', 'om3', 'om6', 'vitB1', 'vitB2', 'vitB5', 'vitB6', 'vitB8', 'vitB9', 'vitB12', 'minMg', 'minNa', 'minCa', 'minCl', 'minK', 'minS', 'minP', 'minI', 'minCu', 'minCr'];
    public static $months = ['січ.','лют.','бер.','квіт.','трав.','черв.','лип.','серп.','вер.','жовт.','лист.','груд.'];
    
    static function getData($table, string $param = "")
    {
        $db = DB::DB();
        $param = $param != "" ? 'WHERE ' . $param : "";
        $res = mysqli_query($db, "SELECT * FROM " . $table . " " . $param . ";");
        $db = DB::close($db);
        if ($res !== FALSE) return mysqli_fetch_all($res);
        else return false;
    }
    static function getDataWithLimit($table, int $limit)
    {
        $db = DB::DB();
        $res = mysqli_query($db, "SELECT * FROM " . $table . " LIMIT " . $limit . ";");
        //echo "SELECT * FROM " . $table . " LIMIT " . $limit . ";";  
        $db = DB::close($db);
        if ($res !== FALSE) return mysqli_fetch_all($res);
        else return false;
    }
    static function getItemById($table, $id)
    {
        $db = DB::DB();
        $res = mysqli_query($db, "SELECT * FROM " . $table . " WHERE id=" . $id . " limit 1;");
        $res2 = mysqli_fetch_all($res);
        $db = DB::close($db);
        $count_res2 = count($res2);
        if ($res == false || $count_res2 == 0) return false;
        else return $res2[0];
    }
    static function getLastItemId()
    {
        $db = DB::DB();
        return mysqli_insert_id($db);
        $db = DB::close($db);
    }
    static function createItem($table, $data)
    {
        $db = DB::DB();
        $columns = [];
        $values = [];
        foreach ($data as $key => $value) {
            array_push($columns, $key);
            if (is_string($value)) array_push($values, "'" . $value . "'");
            else array_push($values, $value);
        }
        $columns_res = join(',', $columns);
        $values_res = join(',', $values);
        mysqli_query($db, "INSERT INTO " . $table . " (" . $columns_res . ") VALUES (" . $values_res . ");");
        $res = mysqli_fetch_array(mysqli_query($db, "SELECT id FROM " . $table . " order by id desc limit 1;"))[0];
        $db = DB::close($db);
        return $res;
    }
    static function updateItem($table, $id, $data)
    {
        $db = DB::DB();
        $data_res = [];
        foreach ($data as $key => $value) {
            array_push($data_res, $key . "='" . $value . "'");
        }
        $data_res2 = join(',', $data_res);
        printf("UPDATE $table SET $data_res2 WHERE id='$id';");
        mysqli_query($db, "UPDATE $table SET $data_res2 WHERE id='$id';");
        $res = Data::getItemById($table, $id);
        $db = DB::close($db);
        return $res;
    }
    static function deleteItem($table, $id)
    {
        $db = DB::DB();
        mysqli_query($db, "DELETE FROM $table WHERE id='$id';");
        $db = DB::close($db);
    }
    static function deleteItemsWhere($table,$condition)
    {
        $db = DB::DB();
        mysqli_query($db, "DELETE FROM $table WHERE $condition;");
        echo "DELETE FROM $table WHERE $condition;";
        $db = DB::close($db);
    }
}

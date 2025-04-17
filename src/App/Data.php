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
    public static $months = ['січ.', 'лют.', 'бер.', 'квіт.', 'трав.', 'черв.', 'лип.', 'серп.', 'вер.', 'жовт.', 'лист.', 'груд.'];

    static function GetData($table, string $param = "", string $orderBy = "", string $end = "")
    {
        $db = DB::DB();
        $param = $param != "" ? 'WHERE ' . $param : "";
        $orderBy = $orderBy != "" ? 'ORDER BY ' . $orderBy : "";
        $query = "SELECT * FROM " . $table . " " . $param . " " . $orderBy . " " . $end . " ;";

        try {
            $res = mysqli_query($db, $query);
            $db = DB::close($db);
            if ($res !== FALSE) return mysqli_fetch_all($res);
            else return false;
        } catch (\Throwable $th) {
            echo $query;
        }
    }
    static function GetCount($table, string $param = "")
    {
        $db = DB::DB();
        $param = $param != "" ? 'WHERE ' . $param : "";
        $query = "SELECT count(*) FROM " . $table . " " . $param;
        try {
            $res = mysqli_query($db, $query);
            $db = DB::close($db);
            if ($res !== FALSE) return mysqli_fetch_all($res)[0][0];
            else return false;
        } catch (\Throwable $th) {
            echo "<p style='color:red'>";
            echo "ERROR: " . $query;
            echo "<p>";
        }
    }
    static function GetDataWithLimit($table, int $limit)
    {
        $db = DB::DB();
        $res = mysqli_query($db, "SELECT * FROM " . $table . " LIMIT " . $limit . ";");
        //echo "SELECT * FROM " . $table . " LIMIT " . $limit . ";";  
        $db = DB::close($db);
        if ($res !== FALSE) return mysqli_fetch_all($res);
        else return false;
    }
    static function GetItemById($table, $id)
    {
        $db = DB::DB();
        $res = mysqli_query($db, "SELECT * FROM " . $table . " WHERE id=" . $id . " limit 1;");
        $res2 = mysqli_fetch_all($res);
        $db = DB::close($db);
        $count_res2 = count($res2);
        if ($res == false || $count_res2 == 0) return false;
        else return $res2[0];
    }
    static function CreateItem($table, $data)
    {
        $db = DB::DB();
        $columns = [];
        $values = [];
        foreach ($data as $key => $value) {
            array_push($columns, $key);
            if (is_string($value)) array_push($values, "'" . $value . "'");
            else if (is_bool($value)) array_push($values, $value ? "TRUE" : "FALSE");
            else if ($value == NULL) array_push($values, "NULL");
            else array_push($values, $value);
        }
        $columns_res = join(',', $columns);
        $values_res = join(',', $values);
        $query = "INSERT INTO " . $table . " (" . $columns_res . ") VALUES (" . $values_res . ");";

        $res_query = mysqli_query($db, $query);
        $res = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM " . $table . " ORDER BY id DESC LIMIT 1;"));
        $db = DB::close($db);
        return $res_query == 1 ? $res : "ERROR:\t" . $query;
    }

    static function UpdateItem($table, $id, $data)
    {
        $db = DB::DB();
        $data_res = [];
        foreach ($data as $key => $value) {
            array_push($data_res, $key . "='" . $value . "'");
        }
        $data_res2 = join(',', $data_res);
        //printf("UPDATE $table SET $data_res2 WHERE id='$id';");
        $res_query = mysqli_query($db, "UPDATE $table SET $data_res2 WHERE id='$id';");
        $res = Data::getItemById($table, $id);
        $db = DB::close($db);
        return $res_query == 1 ? $res : "ERROR:\tUPDATE $table SET $data_res2 WHERE id='$id';";
    }

    static function DeleteItem($table, $id)
    {
        $db = DB::DB();
        echo $id;
        $res = mysqli_query($db, "DELETE FROM $table WHERE id='$id';");
        $db = DB::close($db);
        return (int)$res == 1 ? "Видалення пройшло успішно!" : "ERROR:\tDELETE FROM $table WHERE id='$id';";
    }

    static function DeleteItemsWhere($table, $condition)
    {
        $db = DB::DB();
        mysqli_query($db, "DELETE FROM $table WHERE $condition;");
        echo "DELETE FROM $table WHERE $condition;";
        $db = DB::close($db);
    }

    static function GetLastItemId()
    {
        $db = DB::DB();
        return mysqli_insert_id($db);
        $db = DB::close($db);
    }

    public static function GetTableFields($table)
    {
        $db = DB::DB();
        $res = mysqli_query($db, "DESCRIBE $table");

        $columns = mysqli_fetch_all($res);

        $fields = [];
        // echo '<pre>';
        // print_r($columns);
        // echo '</pre>';
        foreach ($columns as $column) {
            $fields[] = $column[0]; // Поле "Field" містить ім'я стовпця
        }
        $db = DB::close($db);

        return $fields;
    }
}

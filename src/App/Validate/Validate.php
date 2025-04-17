<?php

namespace App\Validate;

use App\Data;

class Validate
{
    static function Validate($prev_page, $data, $id = null)
    {
        $res = false;
        
        $user_id = $_SESSION['user']['id'];
        
        foreach ($data as $key => $item) {
            if (Self::CheckField($prev_page, $key, $item, $id, $user_id)) $res = true;
        }

        if ($res) {
            $_SESSION['validation_data'] = $data;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        } else return $data;
    }

    static function CheckField($prev_page, $field, $value, $id = null, $user_id = null)
    {
        $errors_exist = false;
        switch ($prev_page) {
            case 'person':
                $errors_exist = Self::FieldEmpty($prev_page, $field, $value);
                if ($errors_exist) return $errors_exist;
                if ($field == 'name') {
                    $errors_exist = Self::FieldNotUnique($prev_page, "persons", $field, $value, $id, $user_id);
                }
                break;
            case 'product':
                if ($field == "title" || $field == "product_category_id" || $field == "is_private" || $field == "image_url" || $field == "kcal") $errors_exist = Self::FieldEmpty($prev_page, $field, $value);

                if ($errors_exist) return $errors_exist;
                switch ($field) {
                    case 'title':
                        $errors_exist = Self::FieldNotUnique($prev_page, "products", $field, $value, $id, $user_id);
                        break;
                    case 'image_url':
                        $errors_exist = Self::FieldNotUnique($prev_page, "products", $field, $value, $id, $user_id);
                        break;
                    default:
                        # code...
                        break;
                }
                break;
            case 'shop':
                if($field!='is_private') $errors_exist = Self::FieldEmpty($prev_page, $field, $value);
                if ($errors_exist) return $errors_exist;
                if ($field == 'address') {
                    $errors_exist = Self::FieldNotUnique($prev_page, "shops", $field, $value, $id, $user_id);
                } else if ($field == 'phone') {
                    $errors_exist = Self::FieldNotUnique($prev_page, "shops", $field, $value, $id, $user_id);
                }
                break;
            case 'manufacturer':
                if($field!='is_private') $errors_exist = Self::FieldEmpty($prev_page, $field, $value);
                if ($errors_exist) return $errors_exist;
                if ($field == 'name') {
                    $errors_exist = Self::FieldNotUnique($prev_page, "manufacturers", $field, $value, $id, $user_id);
                }
                break;
            case 'price':
                if ($field != "shop" && $field != "manufacturer"&&$field!="is_private") $errors_exist = Self::FieldEmpty($prev_page, $field, $value);
                if ($errors_exist) return $errors_exist;
                break;
        }
        return $errors_exist;
    }

    static function FieldEmpty($prev_page, $field, $value)
    {
        $errors_exist = false;
        if ($value == "") {
            $field_name = self::FindFieldName($prev_page, $field);
            $_SESSION['errors'][$field . "_is_empty"] = "Введіть поле $field_name";
            $errors_exist = true;
        }
        return $errors_exist;
    }
    static function FieldNotUnique($prev_page, $table, $field, $value, $id = null, $user_id = null)
    {
        $errors_exist = false;
        $param_for_user = $user_id != null ? `AND user_id=$user_id` : ``;
        $check_id = $id != null ? "AND id!=$id" : "";//for update
        $data_for_check = Data::GetData($table, "$field='$value' $check_id $param_for_user");
        
        if ($data_for_check != false) {
            $field_name = self::FindFieldName($prev_page, $field);
            $_SESSION['errors'][$field . "_is_not unique"] = "Значення $value в полі $field_name вже існує";
            $errors_exist = true;
        }

        return $errors_exist;
    }

    static function FindFieldName($prev_page, $field)
    {
        $fields = [
            "person" => [
                "name" => "ім'я",
                "gender" => "стать",
                "date_of_birth" => "дата народження",
                "weight" => "вага",
                "height" => "зріст",
                "activity" => "рівень активності",
            ],
            "product" => [
                "title" => "назва",
                "product_category_id" => "категорія",
                "is_private" => "видимість іншим",
                "image_url" => "посилання на зображення",
                "kcal" => "ккал",
            ],
            "shop" => [
                "name" => "назва",
                "address" => "адреса",
                "phone" => "телефон",
            ],
            "manufacturer" => [
                "name" => "назва",
            ],
            "price" => [
                "product" => "продукт",
                "weight" => "вага",
                "price" => "ціна",
                "shop" => "магазин",
                "manufacturer" => "виробник",
                "is_private" => "видимість іншим",
            ],
        ];
        $res =  $field;

        foreach ($fields[$prev_page] as $key => $f) {
            if ($key == $field) $res = $f;
        }

        return $res;
    }
}

<?php

namespace App\Models;

use App\Data;

abstract class Model
{
    protected $table;
    protected $attributes = [];

    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
    public static function all()
    {
        $instance = new static();
        $items = Data::getData($instance->table);
        $models = [];
        foreach ($items as $item) {
            $models[] = new static(array_combine($instance->getFields(), $item));
        }
        return $models;
    }
    public static function orderBy($field)
    {
        $instance = new static();
        $items = Data::getData($instance->table, "", $field);
        $models = [];
        foreach ($items as $item) {
            $models[] = new static(array_combine($instance->getFields(), $item));
        }
        return $models;
    }
    public static function WhereAndOrderBy($where_options, $order_field)
    {
        $instance = new static();
        $items = Data::getData($instance->table, $where_options, $order_field);
        $models = [];
        foreach ($items as $item) {
            $models[] = new static(array_combine($instance->getFields(), $item));
        }
        return $models;
    }
    public static function WhereAndOrderByWithPagination($where_options, $order_field, $limit, $offset = null)
    {
        $instance = new static();
        $pagination = $offset != null ? "LIMIT " . $limit . " OFFSET " . $offset : " LIMIT " . $limit;
        $items = Data::GetData($instance->table, $where_options, $order_field, $pagination);
        $models = [];
        foreach ($items as $item) {
            $models[] = new static(array_combine($instance->getFields(), $item));
        }
        return $models;
    }

    public static function count($where)
    {
        $instance = new static();
        $count = Data::GetCount($instance->table, $where);
        return $count;
    }

    protected function getFields()
    {
        // Симуляція отримання полів таблиці
        return Data::GetTableFields($this->table);
    }

    // Знаходження запису за ID
    public static function find(int $id)
    {
        $instance = new static();
        $item = Data::getItemById($instance->table, $id);
        if ($item) {
            return new static(array_combine($instance->getFields(), $item));
        }
        return null;
    }

    // Фільтрація за певним полем
    public static function where(array $fields_and_values = null, string $where = null)
    {
        $instance = new static();
        $items = null;

        $fields_and_values_str = "";
        if ($fields_and_values != null) {
            $fields_and_values_str = $fields_and_values[0][0] . "='" . $fields_and_values[0][1] . "'";
            for ($i = 1; $i < count($fields_and_values); $i++) {
                $fields_and_values_str .= " AND " . $fields_and_values[$i][0] . "='" . $fields_and_values[$i][1] . "'";
            }
        }
        $where = $where == null ? "" : $where;

        if (!is_null($fields_and_values)) $items = Data::getData($instance->table, "$fields_and_values_str $where");
        else $items = Data::getData($instance->table, $where);

        $models = [];
        foreach ($items as $item) {
            $models[] = new static(array_combine($instance->getFields(), $item));
        }
        return $models;
    }

    // Створення нового запису
    public function create()
    {
        $attributes = $this->toArray();
        unset($attributes['id']);
        return Data::createItem($this->table, $attributes);
    }
    // Оновлення запису
    public function update(int $id)
    {
        $attributes = $this->toArray();
        unset($attributes['id']);
        return Data::updateItem($this->table, $id, $attributes);
    }

    // Видалення запису
    public function delete($id)
    {
        //return "DELETE " . $id;
        return Data::deleteItem($this->table, $id);
    }

    // Перетворення об'єкта на масив
    public function toArray()
    {
        $fields = $this->getFields();
        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $this->{$field} ?? null;
        }
        return $data;
    }
}

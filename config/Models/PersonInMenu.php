<?php

namespace App\Models;

use App\Data;

class PersonInMenu
{
    public $id;
    public $table = "person_in_menus";
    public $person_id;
    public $menu_id;
    function __construct($menu_id, $person_id, $id = null)
    {
        $this->id = $id;
        $this->person_id = $person_id;
        $this->menu_id = $menu_id;
    }
    public function menu()
    {
        return Menu::find($this->menu_id);
    }
    public function person()
    {
        return Person::find($this->person_id);
    }
    static function find($id)
    {
        $person_in_menu = Data::getItemById('person_in_menus', $id);
        return new PersonInMenu($person_in_menu[1], $person_in_menu[2], $person_in_menu[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("person_in_menus", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $person_in_menus = Data::getData('person_in_menus');
        $res = array();
        foreach ($person_in_menus as $person_in_menu) {
            array_push($res, Self::find($person_in_menu[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('person_in_menus', ['person_id' => $this->person_id, 'menu_id' => $this->menu_id]);
    }
    static function store($data)
    {
        Data::createItem('person_in_menus', $data);
    }
    public function delete()
    {
        Data::deleteItem($this->table, $this->id);
    }
}

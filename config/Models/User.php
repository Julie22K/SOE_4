<?php

namespace App\Models;

use App\Data;

class User
{
    public $id;
    public $full_name = "users";
    public $login;
    public $email;
    public $password;
    function __construct($title, $category_id, $image_url, $data, $id = null)
    {
        $this->id = is_null($id) ? 0 : $id;
        $this->full_name = $full_name;
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
    }
    static function find($id){
        $user = Data::getItemById('users', $id);
        return new Product($user[1], $user[2], $user[3],$user[4], $user[0]);
    }
    static function where($foreign_key, $id){
        $items = Data::getData("users", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $users = Data::getData('users');
        $res = array();
        foreach ($users as $user) {
            array_push($res, Self::find($user[0]));
        }
        return $res;
    }
    public function create()
    {

    }
    static function store()
    {

    }
    public function delete()
    {
        
    }
}

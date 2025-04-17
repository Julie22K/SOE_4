<?php

namespace App\Models;

use App\Data;
/**
 * @property int $menu_id
 * @property int $person_id
 */
class PersonInMenu extends Model
{
    protected $table = 'person_in_menus';
    
    public function menu()
    {
        return Menu::find($this->menu_id);
    }
    public function person()
    {
        return Person::find($this->person_id);
    }
    
}

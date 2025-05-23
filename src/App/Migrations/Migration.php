<?php

namespace App\Migrations;

use App\DB;
use App\Data;
use App\Migrations\MigrationsData;
use App\Models\Person;
use Exception;

class Migration
{
    private $db;
    public function __construct()
    {
        $this->db = DB::DB();
    }
    function run()
    {
        Migration::createMigrations([
            "create_users",
            "create_recipes",
            "create_persons",
            "create_products",
            "create_product_categories",
            "create_recipe_categories",
            "create_prices",
            "create_shops",
            "create_manufacturers",
            "create_ingredients",
            "create_dishes",
            "create_shop_items",
            "create_meal_times",
            "create_menus",
            "create_person_in_menus",
            "fill_recipes",
            "fill_persons",
            "fill_products",
            "fill_product_categories",
            "fill_recipe_categories",
            "fill_prices",
            "fill_shops",
            "fill_manufacturers",
            "fill_ingredients",
            "fill_dishes",
            "fill_shop_items",
            "fill_meal_times",
            "fill_menus",
            "fill_person_in_menus"
        ]);

        //Migration::createTable("users", ["full_name varchar(30)", "login varchar(30)", "email varchar(2000)", "password varchar(2000)","role varchar(30)"]);
        Migration::createTable("products", [
            "title varchar(30)",
            "product_category_id integer",
            "image_url varchar(2000)",
            "user_id integer DEFAULT NULL",
            "is_private boolean DEFAULT false",
            "kcal double DEFAULT 0",
            "water double DEFAULT 0",
            "cellulose double DEFAULT 0",
            "fat double DEFAULT 0",
            "carb double DEFAULT 0",
            "protein double DEFAULT 0",
            "vitA double DEFAULT 0",
            "vitE double DEFAULT 0",
            "vitK double DEFAULT 0",
            "vitD double DEFAULT 0",
            "vitC double DEFAULT 0",
            "om3 double DEFAULT 0",
            "om6 double DEFAULT 0",
            "vitB1 double DEFAULT 0",
            "vitB2 double DEFAULT 0",
            "vitB5 double DEFAULT 0",
            "vitB6 double DEFAULT 0",
            "vitB8 double DEFAULT 0",
            "vitB9 double DEFAULT 0",
            "vitB12 double DEFAULT 0",
            "minMg double DEFAULT 0",
            "minNa double DEFAULT 0",
            "minCa double DEFAULT 0",
            "minCl double DEFAULT 0",
            "minK double DEFAULT 0",
            "minS double DEFAULT 0",
            "minP double DEFAULT 0",
            "minI double DEFAULT 0",
            "minCu double DEFAULT 0",
            "minCr double DEFAULT 0"
        ]);
        Migration::createTable("recipes", [
            "title varchar(30)",
            "recipe_category_id integer",
            "video_url varchar(2000) default ''",
            "image_url varchar(2000) default ''",
            "description varchar(10000) default ''",
            "portions integer default 0",
            "user_id integer DEFAULT NULL",
            "is_private boolean DEFAULT false",
        ]);
        Migration::createTable("persons", [
            "name varchar(20)",
            "gender enum('woman','man')",
            "date_of_birth date",
            "weight integer",
            "height integer",
            "activity enum('1.2','1.4','1.55','1.7','1.9')",
            "user_id integer DEFAULT NULL",
            "is_private boolean DEFAULT false",
            "kcal double DEFAULT 0",
            "water double DEFAULT 0",
            "cellulose double DEFAULT 0",
            "fat double DEFAULT 0",
            "carb double DEFAULT 0",
            "protein double DEFAULT 0",
            "vitA double DEFAULT 0",
            "vitE double DEFAULT 0",
            "vitK double DEFAULT 0",
            "vitD double DEFAULT 0",
            "vitC double DEFAULT 0",
            "om3 double DEFAULT 0",
            "om6 double DEFAULT 0",
            "vitB1 double DEFAULT 0",
            "vitB2 double DEFAULT 0",
            "vitB5 double DEFAULT 0",
            "vitB6 double DEFAULT 0",
            "vitB8 double DEFAULT 0",
            "vitB9 double DEFAULT 0",
            "vitB12 double DEFAULT 0",
            "minMg double DEFAULT 0",
            "minNa double DEFAULT 0",
            "minCa double DEFAULT 0",
            "minCl double DEFAULT 0",
            "minK double DEFAULT 0",
            "minS double DEFAULT 0",
            "minP double DEFAULT 0",
            "minI double DEFAULT 0",
            "minCu double DEFAULT 0",
            "minCr double DEFAULT 0"
        ]);
        Migration::createTable("product_categories", [
            "name varchar(20)",
            "image_name varchar(20)",
            "user_id integer DEFAULT NULL",
        ]);
        Migration::createTable("recipe_categories", [
            "name varchar(20)",
            "image_name varchar(20)",
            "user_id integer DEFAULT NULL",
        ]);
        Migration::createTable("prices", [
            "price double",
            "weight integer",
            "product_id integer",
            "manufacturer_id integer",
            "shop_id integer",
            "user_id integer DEFAULT NULL",
            "is_private boolean DEFAULT false",
        ]);
        Migration::createTable("shops", [
            "name varchar(30)",
            "phone varchar(13)",
            "address varchar(30)",
            "user_id integer DEFAULT NULL",
            "is_private boolean DEFAULT false",
        ]);
        Migration::createTable("manufacturers", [
            "name varchar(30)",
            "user_id integer DEFAULT NULL",
            "is_private boolean DEFAULT false",
        ]);
        Migration::createTable("ingredients", [
            "weight integer",
            "recipe_id integer",
            "product_id integer"
        ]);
        Migration::createTable("dishes", [
            "date date",
            "meal_time_id integer",
            "recipe_id integer",
            "menu_id integer",
            "user_id integer DEFAULT NULL",
            "is_private boolean DEFAULT false",
        ]);
        Migration::createTable("shop_items", [
            "ingredient_id integer",
            "product_id integer",
            "dish_id integer",
            "is_exists boolean DEFAULT false",
            "price double DEFAULT 0"
        ]);
        Migration::createTable("meal_times", [
            "name varchar(30)",
            "priority integer",
            "is_use boolean DEFAULT true",
            "user_id integer DEFAULT NULL",
            "is_private boolean DEFAULT false", //FIXME:
        ]);
        Migration::createTable("menus", [
            "budget integer",
            "first_date date",
            "last_date date",
            "user_id integer DEFAULT NULL",
            "is_private boolean DEFAULT false",
        ]);
        Migration::createTable("person_in_menus", [
            "menu_id integer",
            "person_id integer"
        ]);

        Migration::fillTable("meal_times");
        Migration::fillTable("recipe_categories");
        Migration::fillTable("product_categories");
        Migration::fillTable("shops");
        Migration::fillTable("manufacturers");
        Migration::fillTable("products");
        Migration::fillTable("persons");
        Migration::fillTable("recipes");
        Migration::fillTable("ingredients");
        Migration::fillTable("menus");
        Migration::fillTable("person_in_menus");
        Migration::fillTable("prices");
        Migration::fillTable("dishes");
        Migration::fillTable("shop_items");
    }
    function runForUser($user_id)
    {
        Migration::add_migrations([
            "fill_meal_times_for_user_" . $user_id,
            "fill_persons_for_user_" . $user_id,
        ]);
        Migration::fillTableforUser("meal_times", $user_id);
        Migration::fillTableforUser("persons", $user_id);
        // Migration::fillTable("recipe_categories");
        // Migration::fillTable("product_categories");
        // Migration::fillTable("shops");
        // Migration::fillTable("manufacturers");
        // Migration::fillTable("products");
        // Migration::fillTable("recipes");
        // Migration::fillTable("ingredients");
        // Migration::fillTable("menus");
        // Migration::fillTable("person_in_menus");
        // Migration::fillTable("prices");
        // Migration::fillTable("dishes");
        // Migration::fillTable("shop_items");

        //update user norms
        foreach (Person::all() as $person_) {
            $person_->CalcNorms();
            $person_->update($person_->id);
        }
    }
    function createMigrations(array $migrations)
    {
        // mysqli_query($this->db, "SHOW TABLES LIKE 'migrations'");

        $columns_ = join(",", ["name varchar(30) unique", "is_exists boolean default false"]);
        mysqli_query($this->db, "CREATE TABLE IF NOT EXISTS `migrations` (id integer NOT NULL AUTO_INCREMENT, $columns_, PRIMARY KEY (id));");

        Migration::fill_migrations($migrations);

        //FIXME:

    }
    function fill_migrations($migrations)
    {
        $table = Data::getData("migrations");
        if (count($table) == 0) {
            foreach ($migrations as $migration) {
                Data::createItem("migrations", ["name" => $migration]);
            }
        }
    }
    function add_migrations($migrations)
    {
        foreach ($migrations as $migration) {
            $items = Data::GetData("migrations", "name='" . $migration . "'");
            if (count($items) == 0) {
                Data::createItem("migrations", ["name" => $migration]);
            }
        }
    }
    function createTable($table, $columns)
    {
        $name_migration = "create_" . $table;
        $migration = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * from migrations where name='$name_migration'"));
        if ($migration !== false && !is_null($migration)) {
            $is_exists = $migration["is_exists"];
            if ($is_exists != true) {
                $columns_ = join(",", $columns);
                mysqli_query($this->db, "CREATE TABLE $table (id integer NOT NULL AUTO_INCREMENT, $columns_, PRIMARY KEY (id));");

                mysqli_query($this->db, "UPDATE migrations SET is_exists=true WHERE name='$name_migration';");
            }
        }
    }
    function fillTable($table)
    {
        $name_migration = "fill_" . $table;
        $migration = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * from migrations where name='$name_migration'"));
        if ($migration !== false && !is_null($migration)) {
            $is_exists = $migration["is_exists"];
            if ($is_exists != true) {
                $data = MigrationsData::data();
                foreach ($data[$table] as $item) {
                    Data::createItem($table, $item);
                }
                $res = Data::getData($table);
                mysqli_query($this->db, "UPDATE migrations SET is_exists=true WHERE name='$name_migration';");
            }
        }
    }
    function fillTableforUser($table, $user_id)
    {
        //todo
        $name_migration = "fill_" . $table . "_for_user_" . $user_id;
        $migration = mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * from migrations where name='$name_migration'"));
        if ($migration !== false && !is_null($migration)) {
            $is_exists = $migration["is_exists"];
            if ($is_exists != true) {
                $data = MigrationsData::data();

                foreach ($data[$table] as $item) {
                    $item['user_id'] = $user_id;
                    $res=Data::createItem($table, $item);
                }
                
                $res = Data::getData($table);
                mysqli_query($this->db, "UPDATE migrations SET is_exists=true WHERE name='$name_migration';");
            }
        }
    }
}

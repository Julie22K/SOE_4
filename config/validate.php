<?php

namespace App;


class Validate
{
    static function Validate($prev_page,$data)
    {
        $res=false;
        foreach($data as $key=>$item){
            if($item=="") {
                echo $item;
                $_SESSION['errors'][$key] = "Введіть поле $key!";
                $res=true;
            }

        }
        if($res) header("Location: ../../public/add/$prev_page.php");
        else return $data;
    }
}

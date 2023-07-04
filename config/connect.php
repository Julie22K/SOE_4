<?php

namespace App;

class DB
{
    public static function DB()
    {
        $par1_ip = "127.0.0.1";
        $par2_name = 'root';
        $par3_p = '';
        $par4_dp = 'soe';
        $soe = mysqli_connect($par1_ip, $par2_name, $par3_p, $par4_dp);
        mysqli_set_charset($soe, 'utf8');
        if (!$soe) {
            echo "error";
        }
        return $soe;
    }
    public static function close($db)
    {
        $db->close();
    }
}

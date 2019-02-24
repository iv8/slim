<?php

namespace App\Services;

class Config
{
    public static function get($key)
    {
        global $System_Config;
        return $System_Config[$key];
    }

    public static function set($key, $value)
    {
        global $System_Config;
        $System_Config[$key] = $value;
    }


    public static function getDbConfig()
    {
      	$mysql = self::get('mysql');
        return [
            'driver'    => 'mysql',
            'host'      => $mysql['host'],
            'database'  => $mysql['db'],
            'username'  => $mysql['user'],
            'password'  => $mysql['pwd'],
            'charset'   => $mysql['charset'],
            'collation' => $mysql['collation'],
            'prefix'    => ''
        ];
    }


}

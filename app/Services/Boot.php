<?php

namespace App\Services;

use Illuminate\Database\Capsule\Manager as Capsule;

class Boot
{
    public static function setDebug()
    {
        ini_set("display_errors", "Off");
        // debug
        if (Config::get('debug') == true) {
            define("DEBUG", true);
            ini_set("display_errors", "On");
        }
    }

    public static function setTimezone()
    {
        // config time zone
        date_default_timezone_set(Config::get('timeZone'));
    }

    public static function bootDb()
    {
        // Init Eloquent ORM Connection
        $capsule = new Capsule;
        $capsule->addConnection(Config::getDbConfig(), 'default');
        $capsule->bootEloquent();
    }
}

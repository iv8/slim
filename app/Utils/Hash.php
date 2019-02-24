<?php

namespace App\Utils;

use App\Services\Config;

class Hash
{
    public static function cookieHash($str)
    {
        return substr(hash('sha256', $str . Config::get('salt')), 5, 45);
    }

    public static function sha256WithSalt($pwd)
    {
        return hash('sha256', $pwd . Config::get('salt'));
    }

    public static function checkPassword($hashedPassword, $password)
    {
        if ($hashedPassword == self::sha256WithSalt($password)) {
            return true;
        }
        return false;
    }
}

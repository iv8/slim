<?php

namespace App\Services;

use App\Utils\Cookie;
use App\Models\User;
use App\Utils\Hash;

class Auth
{
    public static function login($uid, $time)
    {
        $user = User::find($uid);
        $key = Hash::cookieHash(substr($user->passwd, 0, 10));
        $expire_in = $time+time();
        Cookie::set([
            "uid" => $uid,
            "email" => $user->email,
            "key" => $key,
            "ip" => md5($_SERVER["REMOTE_ADDR"].Config::get('key').$uid.$expire_in),
            "expire_in" => $expire_in
        ], $expire_in);
    }

    public static function getUser()
    {
        $uid = Cookie::get('uid');
        $key = Cookie::get('key');
        $ip = Cookie::get('ip');

        $expire_in = Cookie::get('expire_in');

        if ($uid == null) {
            $user = new User();
            $user->isLogin = false;
            return $user;
        }

      	$user = User::find($uid);
        if ($user == null) {
            $user = new User();
            $user->isLogin = false;
            return $user;
        }

      	# 修改密码后检测
        if (Hash::cookieHash(substr($user->passwd, 0, 10)) != $key) {
            $user->isLogin = false;
            return $user;
        }
        $user->isLogin = true;
        return $user;
    }

    public static function logout()
    {
        $time = time() - 1000;
        Cookie::set([
            "uid" => null,
            "email" => null,
            "key" => null
        ], $time);
    }
}

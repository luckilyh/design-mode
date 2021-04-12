<?php

namespace Tool;
//工厂模式
class Factory
{
    static function createDatabase()
    {
        $db = new Database();
        Register::set('db', $db);//环境初始化，先在工厂模式中生产对象，在通过注册树模式注册
        return $db;
    }

    /**
     * 数据对象映射模式结合工厂模式、注册器模式使用
     * @param $id
     * @return User
     */
    static function getUser($id)
    {
        $key = 'user_' . $id;
        $user = Register::get($key);
        if (!$user) {
            $user = new \Tool\User($id);
            Register::set($key, $user);
        }

        return $user;
    }
}
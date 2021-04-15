<?php

namespace Tool;
//工厂模式
use Tool\Database\PDO;

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

    static function getDatabase($name = 'master')
    {
        $config = new \Tool\Config(__DIR__ . '/configs');
        $key = 'database_' . $name;
        if ($name == 'slave') {
            $slaves = $config['database']['slave'];
            $db_conf = $slaves[rand($slaves)];
        } else {
            $db_conf = $config['database']['master'];
        }
        $db = Register::get($key);
        if (!$db) {
            new Database();
            $db = new PDO();
            $db->connect($db_conf['host'], $db_conf['user'], $db_conf['password'], $db_conf['dbname']);
            Register::set($key, $db);
        }
        return $db;
    }
}
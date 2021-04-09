<?php

namespace IMooc;
//工厂模式
class Factory
{
    static function createDatabase()
    {
        $db = new Database();
        Register::set('db',$db);//注册树模式
        return $db;
    }
}
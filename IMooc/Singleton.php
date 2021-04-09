<?php

namespace IMooc;
//单例模式
class Singleton
{
    static private $db;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    static function getInstance()
    {
        if (self::$db) {
            return self::$db;
        } else {
            self::$db = new self();
            return self::$db;
        }
    }

    public function test(){
        echo 'test';
    }
}
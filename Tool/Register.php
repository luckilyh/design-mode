<?php

namespace Tool;
//注册树模式
class Register
{
    protected static $objects;

    public static function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    public static function get($alias)
    {
        if (isset(self::$objects[$alias])) {
            return self::$objects[$alias];
        } else {
            return false;
        }
    }

    public static function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}
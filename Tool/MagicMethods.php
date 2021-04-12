<?php

namespace Tool;

class MagicMethods
{
    protected $array = [];

    function __set($key, $value)
    {
        $this->array[$key] = $value;
    }

    function __get($key)
    {
        return $this->array[$key];
    }

    function __call($name, $arguments)
    {
        return "magic function";
    }

    static function __callStatic($name, $arguments)
    {
        return "magic static function";
    }

    function __toString()
    {
        return __CLASS__;
    }

    function __invoke($param)
    {
        var_dump($param);
        return 'invoke';
    }
}
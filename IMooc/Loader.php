<?php

namespace IMooc;

class Loader
{
    static function autoload($class)
    {
        require BASEDIR . '/' . $class . '.php';
    }
}
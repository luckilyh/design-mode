<?php

namespace IMooc;

class Database
{
    function where($where)
    {
        return $this; //链式操作的关键
    }

    function order($order)
    {
        return $this;
    }

    function limit($limit)
    {
        return $this;
    }
}
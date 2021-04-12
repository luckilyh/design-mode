<?php

namespace Tool;

interface IDatabase
{
    function connect($host, $user, $passwd, $dbname);

    function query($sql);

    function close();
}

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
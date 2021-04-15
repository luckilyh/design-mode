<?php

namespace Tool\Database;
//适配器模式
use Tool\IDatabase;

class PDO implements IDatabase
{
    protected $conn;

    function connect($host, $user, $passwd, $dbname)
    {
        $conn = new \PDO("mysql:host={$host};dbname={$dbname};", $user, $passwd);
        $this->conn = $conn;
    }

    function query($sql)
    {
        $res = $this->conn->query($sql);
        return $res;
    }

    function prepare($sql)
    {
        $res = $this->conn->prepare($sql);
        return $res->execute();
    }

    function close()
    {
        unset($this->conn);
    }
}
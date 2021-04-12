<?php

namespace Tool\Database;
//适配器模式
use Tool\IDatabase;

class MySQLi implements IDatabase
{
    protected $conn;

    function connect($host, $user, $passwd, $dbname)
    {
        $conn = mysqli_connect($host, $user, $passwd, $dbname);
        $this->conn = $conn;
    }

    function query($sql)
    {
        $res = mysqli_query($this->conn, $sql);
        return $res;
    }

    function close()
    {
        mysqli_close($this->conn);
    }
}
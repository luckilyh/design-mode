<?php

namespace Tool;
//代理模式
class Proxy implements IUserPorxy
{
    protected $db;

    function __construct()
    {
        $this->db = new \Tool\Database\PDO();
        $this->db->connect('mysql', 'root', 'root', 'default');
    }

    function getUserName($id)
    {
        $res = $this->db->query("select name from user where `id`={$id} limit 1");
        return $res->fetch(\PDO::FETCH_ASSOC);
    }

    function setUserName($id, $name)
    {
        return $this->db->prepare("update user set `name`='{$name}' where `id`={$id}");
    }
}
<?php

namespace Tool;
//数据对象映射模式
class User
{
    public $id;
    public $name;
    public $mobile;
    public $regtime;

    protected $db;

    function __construct($id)
    {
        $this->db = new \Tool\Database\PDO();
        $this->db->connect('mysql', 'root', 'root', 'default');
        $res = $this->db->query("select * from user where `id`={$id} limit 1");
        $data = $res->fetch(\PDO::FETCH_ASSOC);
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->mobile = $data['mobile'];
        $this->regtime = $data['regtime'];
    }

    function __destruct()
    {
        try {
            $this->db->query("update user set `name`='{$this->name}',`mobile`='{$this->mobile}',`regtime`='{$this->regtime}' where `id`={$this->id} ");
            echo '<br />';
        }catch (Exception $e){
            var_dump($e);
        }
    }
}
<?php

namespace Tool;
//迭代器模式
class AllUser implements \Iterator
{
    protected $ids;
    protected $index;
    protected $data = [];

    function __construct()
    {
        $db = new \Tool\Database\PDO();
        $db->connect('mysql', 'root', 'root', 'default');
        $res = $db->query('select id from user order by id asc');
        $this->ids = $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    function current()
    {
        $id = $this->ids[$this->index]['id'];
        return Factory::getUser($id);
    }

    function key()
    {
        return $this->index;
    }

    function next()
    {
        ++$this->index;
    }

    function rewind()
    {
        $this->index = 0;
    }

    function valid()
    {
        return $this->index < count($this->ids);
    }
}
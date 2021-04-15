<?php

namespace Tool;
//代理模式
interface IUserPorxy
{
    function getUserName($id);

    function setUserName($id, $name);
}
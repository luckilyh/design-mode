<?php

namespace Tool;
//装饰器模式
interface DrawDecorator
{
    function beforeDraw();

    function afterDraw();
}
<?php

namespace Tool\Decorator;
//装饰器模式
use Tool\DrawDecorator;

class SizeDrawDecorator implements DrawDecorator
{
    protected $size;

    function __construct($size = '14')
    {
        $this->size = $size;
    }

    function beforeDraw()
    {
        echo "<div style='font-size: {$this->size}px'>";
    }

    function afterDraw()
    {
        echo "</div>";
    }
}
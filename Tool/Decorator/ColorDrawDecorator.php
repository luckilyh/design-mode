<?php

namespace Tool\Decorator;
//装饰器模式
use Tool\DrawDecorator;

class ColorDrawDecorator implements DrawDecorator
{
    protected $color;

    function __construct($color = 'red')
    {
        $this->color = $color;
    }

    function beforeDraw()
    {
        echo "<div style='color: {$this->color}'>";
    }

    function afterDraw()
    {
        echo "</div>";
    }
}
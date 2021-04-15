<?php

namespace Tool;
//原型模式
class Canvas
{
    public $data;

    protected $decorators = [];

    function init($width = 20, $height = 10)
    {
        $data = [];
        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $data[$i][$j] = '*';
            }
        }
        $this->data = $data;
    }

    //--装饰器模式
    function addDecorator(DrawDecorator $decorator)
    {
        $this->decorators[] = $decorator;
    }

    function beforeDraw()
    {
        foreach ($this->decorators as $decorator) {
            $decorator->beforeDraw();
        }
    }

    function afterDraw()
    {
        $decorator = array_reverse($this->decorators);
        foreach ($this->decorators as $decorator) {
            $decorator->afterDraw();
        }
    }

    //--装饰器模式

    function draw()
    {
        $this->beforeDraw();
        foreach ($this->data as $line) {
            foreach ($line as $char) {
                echo $char;
            }
            echo "<br />\n";
        }
        $this->afterDraw();
    }

    function rect($a1, $a2, $b1, $b2)
    {
        foreach ($this->data as $k1 => $line) {
            if ($k1 < $a1 || $k1 > $a2) continue;
            foreach ($line as $k2 => $char) {
                if ($k2 < $b1 || $k2 > $b2) continue;
                $this->data[$k1][$k2] = '&nbsp;';
            }
        }
    }
}
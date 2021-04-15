<?php

namespace Tool;
//观察者模式
abstract class EventGenerator
{
    private $observers = [];
    function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}
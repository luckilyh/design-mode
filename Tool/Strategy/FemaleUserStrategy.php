<?php

namespace Tool\Strategy;

use Tool\UserStrategy;

class FemaleUserStrategy implements UserStrategy
{
    function showAd()
    {
        echo '2021新款女装';
    }

    function showCategory()
    {
        echo '女装';
    }
}
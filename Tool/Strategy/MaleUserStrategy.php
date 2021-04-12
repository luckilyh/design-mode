<?php

namespace Tool\Strategy;

use Tool\UserStrategy;

class MaleUserStrategy implements UserStrategy
{
    function showAd()
    {
        echo '华为P40';
    }

    function showCategory()
    {
        echo '电子产品';
    }
}
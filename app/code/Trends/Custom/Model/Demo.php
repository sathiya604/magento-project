<?php

namespace Trends\Custom\Model;

class Demo implements \Trends\Custom\Api\DemoInterface
{
    /**
    *@inheritDoc
    */

    public function getName($name)
    {
        return "Hello Welcome, " . $name;
    }
}

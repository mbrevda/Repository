<?php

namespace Mbrevda\Repository\Operators;

use Mbrevda\Repository\SqlDriver;

class Unequals extends SqlDriver
{

    public function __invoke($a, $b)
    {
        return $a . ' <> ' . $b;
    }
}

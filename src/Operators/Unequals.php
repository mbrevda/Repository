<?php

namespace Mbrevda\Repository\Operators;

class Unequals
{
    public function __construct($query)
    {
        $this->query = $query;
    }

    public function __invoke($a, $b)
    {
        $this->query->where($a ' <> ?', $b);
    }
}

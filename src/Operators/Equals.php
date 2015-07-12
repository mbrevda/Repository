<?php

namespace Mbrevda\Repository\Operators;

class Equals
{
    public function __construct($query)
    {
        $this->query = $query;
    }

    public function __invoke($field, $value)
    {
        $this->query->where($field . ' = ?', $value);
    }
}

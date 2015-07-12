<?php

namespace Mbrevda\Repository;

use Aura\SqlQuery\QueryFactory;
use Mbrevda\Repository\Operators\Equals;

class AuraSqlQueryDriver
{
    public function __construct()
    {
        $query_factory = new QueryFactory('sqlite');
        $this->query =  $query_factory->newSelect();
    }

    public function equals($value, $field)
    {
        (new Equals($this->query))->__invoke($field, $value);

        return $this->query;
    }
}

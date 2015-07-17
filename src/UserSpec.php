<?php

namespace Mbrevda\Repository;

use Mbrevda\QueryBuilder\CompositeQuery;

class UserSpec extends CompositeQuery
{
    public function __construct($sqlquery)
    {
        $this->sqlquery = $sqlquery;

        $this->sqlquery
            ->from('myTable')
            ->cols([
                'firstName',
                'lastName',
                'id'
            ]);
    }

    public function selectSatisfying($spec)
    {
        $queryItems = $spec->selectSatisfying($this);
        //print_r($queryItems);
        $asString = $queryItems->toString();

        return $this->sqlquery->where(substr($asString, 1, -1));
    }
}

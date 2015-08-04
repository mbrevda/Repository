<?php

namespace Mbrevda\Repository;

use Mbrevda\QueryBuilder\CompositeQuery;

class UserSpec extends CompositeQuery
{
    public $isTop = true;
    public function asSql($query)
    {
        $query
            ->from('myTable')
            ->cols([
                'firstName',
                'lastName',
                'id'
            ]);

        parent::asSql($query);
    }
    
}

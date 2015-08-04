<?php

namespace Mbrevda\Repository;

use \Mbrevda\QueryBuilder\CompositeQuery;
use \Mbrevda\Repository\UserSpec;
use \Aura\SqlQuery\QueryFactory;

class Repository
{
    public function __construct()
    {
        $query_factory = new QueryFactory('mysql');
        $this->sqlquery =  $query_factory->newSelect();
    }

    public function selectSatisfying($spec)
    {
        $q = $spec->selectSatisfying(new CompositeQuery);
        //print_r($q);
        $where = $q->asSql($this->sqlquery);
        //print_r($where);
        if ($where) {
            $this->sqlquery->where($where);
        }

        return $this->sqlquery->getStatement();
    }

}

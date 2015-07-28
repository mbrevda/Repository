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

        if ($where) {
            /*if (substr($where, 1, 1) == '(' && substr($where, -1) == ')') {
                $where = substr($where, 1, -1);
            }*/

            $this->sqlquery->where($where);
        }

        return $this->sqlquery->getStatement();
    }

}

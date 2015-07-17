<?php

namespace Mbrevda\Repository;

use \Mbrevda\QueryBuilder\Builder;
use \Mbrevda\Repository\UserSpec;
use \Aura\SqlQuery\QueryFactory;

class Repository
{
    public function __construct()
    {

        $query_factory = new QueryFactory('mysql');
        $this->sqlquery =  $query_factory->newSelect();
        $this->builder = new Builder($this->sqlquery);
    }

    public function selectSatisfying($spec)
    {
        return $this->builder->build($spec->selectSatisfying($this));
    }

    public function userSpec($spec)
    {
        $userQuery = new UserSpec($this->sqlquery);
        $q = $userQuery->selectSatisfying($spec);
        
        return $q->getStatement();
    }

}

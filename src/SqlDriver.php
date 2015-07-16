<?php

namespace Mbrevda\Repository;

use \Aura\SqlQuery\QueryFactory;
use \Mbrevda\Repository\Operators\Equals;
use \Mbrevda\Repository\Operators\UserSpec;
use \Mbrevda\Repository\Operators\AndX;
use \Mbrevda\Repository\Operators\OrX;

class SqlDriver
{
    protected $table;
    protected $columns  = [];
    protected $where    = [];
    protected $orWhere  = [];
    protected $offset   = null;
    protected $limit    = null;

    /*public function __construct()
    {
        $query_factory = new QueryFactory('sqlite');
        $this->query =  $query_factory->newSelect();
    }*/

    public function withTable($table)
    {
        $this->table = $table;

        return $this;
    }

    public function withColumns($columns)
    {
        if (is_array($columns)) {
            $this->columns = array_merge($this->columns, $columns);
        }

        if ($columns == '*') {
            $this->columns = ['*'];
        }


        return $this;
    }

    public function withLimit($limit)
    {
        $this->limit = $limit;


        return $this;
    }

    public function withOffset($offset)
    {
        $this->offset = $offset;


        return $this;
    }

    public function withWhere($where)
    {
        $this->where[] = $where;


        return $this;
    }

    public function withOrWhere($where)
    {
        $this->orWhere[] = $where;


        return $this;
    }

    public function toString()
    {
        /*return print_r([
            'table' => $this->table,
            'columns' => $this->columns,
            'offset' => $this->offset,
            'limit' => $this->limit,
            'where' => $this->where,
            'orWhere' => $this->orWhere,
        ], true);*/

        $q = (new QueryFactory('sqlite'))->newSelect()
            ->cols($this->columns)
            ->from($this->table);

        if ($this->offset) {
            $q->offset($this->offset);
        }

        if ($this->limit) {
            $q->limit($this->limit);
        }

        foreach ($this->where as $where) {
            $q->where($where);
        }

        foreach ($this->orWhere as $orWhere) {
            $q->orWhere($orWhere);
        }

        return $q->getStatement();

    }

    public function equals($value, $field)
    {
        return new Equals($this, $field, $value);
    }

    public function userSpec()
    {
        return new UserSpec($this);
    }

    public function andX($spec1, $spec2 = '')
    {
        return new AndX($this, $spec1, $spec2);
    }

    public function orX($spec1, $spec2 = '')
    {
        return new OrX($this, $spec1, $spec2);
    }

    public function selectSatisfying()
    {
        return $this;
    }
}

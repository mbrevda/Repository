<?php

namespace Mbrevda\Repository;

class Repository
{
    private $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function selectSatisfying($spec)
    {
        $q = $spec->selectSatisfying($this->driver);

        return $q;
    }

}

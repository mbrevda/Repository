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
        return $spec->selectSatisfying($this->driver);
    }

}

<?php

namespace Mbrevda\Repository\Operators;

use Mbrevda\Repository\SqlDriver;

class UserSpec extends SqlDriver
{
    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function selectSatisfying()
    {
        return $this->driver
            ->withTable('myTable')
            ->withColumns([
                'firstName',
                'lastName',
                'id'
            ]);
    }
}

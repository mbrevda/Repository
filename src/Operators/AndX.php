<?php

namespace Mbrevda\Repository\Operators;

use Mbrevda\Repository\SqlDriver;

class AndX extends SqlDriver
{
    public function __construct($driver, $spec1, $spec2)
    {
        $this->driver = $driver->selectSatisfying();
        $this->spec1 = $spec1;
        $this->spec2 = $spec2;
    }

    public function selectSatisfying()
    {
        $one = $this->spec1->selectSatisfying($this->driver);
        $two = $this->spec2 ? $this->spec2->selectSatisfying($this->driver) : '';

        if (!$two) {
            return $this->driver->withWhere($one);
        }
        return $this->driver->withWhere('(' . $one . '  AND ' . $two . ')');
    }
}

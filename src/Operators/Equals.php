<?php

namespace Mbrevda\Repository\Operators;

use Mbrevda\Repository\SqlDriver;

class Equals extends SqlDriver
{
    public function __construct($driver, $field, $value)
    {
        $this->driver = $driver;
        $this->field = $field;
        $this->value = $value;
    }

    public function selectSatisfying()
    {
        return $this->driver->withWhere($this->__toString());
    }

    public function __toString()
    {
        return $this->field . ' = ' . $this->value;
    }
}

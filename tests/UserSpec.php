<?php

use \Mbrevda\Specification\Connectives\CompositeSpecification;

class UserSpec extends CompositeSpecification
{

    public function isSatisfiedBy($candidate, $foo = '')
    {
        return $candidate->isInCollection;
    }

    public function selectSatisfying($ob)
    {
        return $ob->userSpec();
    }
}

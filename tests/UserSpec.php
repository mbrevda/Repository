<?php

use \Mbrevda\Specification\Connectives\CompositeSpecification;
use Mbrevda\Repository\UserSpec as UserSpecQuery;

class UserSpec extends CompositeSpecification
{

    public function isSatisfiedBy($candidate, $foo = '')
    {
        return $candidate->isInCollection;
    }

    public function selectSatisfying($ob)
    {
        return parent::selectSatisfying(new UserSpecQuery);
    }
}

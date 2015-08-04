<?php

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../../specification/vendor/autoload.php';
include __DIR__ . '/../../QueryBuilder/vendor/autoload.php';
include __DIR__ . '/UserSpec.php';

use \Mbrevda\Repository\Repository;
use \Mbrevda\Specification\Extractors\Property;
use \Mbrevda\Specification\Operators\Equals;
use \Mbrevda\Specification\Connectives\AndX;
use \Mbrevda\Specification\Connectives\OrX;

$repo               = new Repository;
$userSpec           = new UserSpec();

$spec = $userSpec
    ->andX(new Equals('true', new Property('active')))
    ->andX(new Equals('true', new Property('member')))
    ->andX(
        new AndX(
            new Equals('Jack', new Property('firstName')),
            new Equals('Black', new Property('lastName'))
        )
    )
    ->orX(
        new AndX(
            new Equals('Charlie', new Property('firstName')),
            new Equals('Brown', new Property('lastName'))
        )
    );
//print_r($spec);
echo $repo->selectSatisfying($spec) . PHP_EOL;

//echo $spec . PHP_EOL;

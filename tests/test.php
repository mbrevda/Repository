<?php

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../../specification/vendor/autoload.php';
include __DIR__ . '/UserSpec.php';

use \Mbrevda\Repository\Repository;
use \Mbrevda\Repository\SqlDriver;
use \Mbrevda\Specification\Operators\Factory as oFactory;
use \Mbrevda\Specification\Extractors\Factory as eFactory;
use \Mbrevda\Specification\Connectives\Factory as cFactory;
use \Mbrevda\Repository\Operators\AndX;

$firstName      = (new eFactory)->property('firstName');
$lastName       = (new eFactory)->property('lastName');
$extractActive  = (new eFactory)->property('active');
$repo           = new Repository(new SqlDriver);

$firstNameIsCharlie = (new oFactory)->equals('Charlie', $firstName);
$firstNameIsJack    = (new oFactory)->equals('Jack', $firstName);
$lastNameIsBrown    = (new oFactory)->equals('Brown', $lastName);
$lastNameIsBlack    = (new oFactory)->equals('Black', $lastName);
$isActive           = (new oFactory)->equals('true', $extractActive);

$driver             = new SqlDriver;
$userSpec           = $driver->userSpec();

$spec = $userSpec
    ->andX($firstNameIsCharlie, $lastNameIsBrown)
    ->orX($driver->andX($firstNameIsJack, $lastNameIsBlack))
    ->andX($isActive);

$q = $repo->selectSatisfying($spec);

echo $q->toString() . PHP_EOL;

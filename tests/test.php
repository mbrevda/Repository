<?php

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../../specification/vendor/autoload.php';
include __DIR__ . '/UserSpec.php';

use \Mbrevda\Repository\Repository;
use \Mbrevda\Repository\SqlDriver;
use \Mbrevda\Specification\Operators\Factory as oFactory;
use \Mbrevda\Specification\Extractors\Property;
use \Mbrevda\Specification\Operators\Equals;
use \Mbrevda\Specification\Extractors\Factory as eFactory;
use \Mbrevda\Specification\Connectives\Factory as cFactory;
use \Mbrevda\Repository\Operators\AndX;

$firstName      = new Property('firstName');
$lastName       = new Property('lastName');
$extractActive  = new Property('active');
$repo           = new Repository(new SqlDriver);

$firstNameIsCharlie = new Equals('Charlie', $firstName);
$firstNameIsJack    = new Equals('Jack', $firstName);
$lastNameIsBrown    = new Equals('Brown', $lastName);
$lastNameIsBlack    = new Equals('Black', $lastName);
$isActive           = new Equals('true', $extractActive);

$driver             = new SqlDriver;
$userSpec           = $driver->userSpec();

$spec = $userSpec
    ->andX($firstNameIsCharlie, $lastNameIsBrown)
    ->orX($driver->andX($firstNameIsJack, $lastNameIsBlack))
    ->andX($isActive);

$q = $repo->selectSatisfying($spec);

echo $q->toString() . PHP_EOL;

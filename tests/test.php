<?php

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../../specification/vendor/autoload.php';

use \Mbrevda\Repository\Repository;
use \Mbrevda\Repository\AuraSqlQueryDriver;
use \Mbrevda\Specification\Operators\Factory as oFactory;
use \Mbrevda\Specification\Extractors\Factory as eFactory;

$repo = new Repository(new AuraSqlQueryDriver);
$spec = (new oFactory)->equals('Charlie', (new eFactory)->property('name'));
$q = $repo->selectSatisfying($spec);
$q->cols(['*']);
$q->from('myTable');

echo str_replace("\n", ' ', $q) . PHP_EOL;
print_r($q->getBindValues());

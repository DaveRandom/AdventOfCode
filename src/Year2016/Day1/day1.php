#!/usr/bin/env php
<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2016\Day1;

use DaveRandom\AdventOfCode\Utils\ByteDelimitedStreamIterator;

require __DIR__ . '/../../../vendor/autoload.php';

$journey = new Journey();

foreach (ByteDelimitedStreamIterator::fromInput(',') as $direction) {
    $journey->followDirection(new Direction($direction));
}

echo "
  Final coordinate distance from start:           {$journey->getCurrentDistanceFromStart()}
  First revisited coordinate distance from start: {$journey->getFirstRevisitedCoordinateDistanceFromStart()}
";

#!/usr/bin/env php
<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2016\Day1;

use function DaveRandom\AdventOfCode\app_init;

require __DIR__ . '/../../../vendor/autoload.php';

$fp = app_init();

$journey = new Journey();
$direction = new Direction();

while (false !== $char = fgetc($fp)) {
    if ($char !== ',') {
        $direction->addChar($char);
    } else {
        $journey->followDirection($direction);
        $direction = new Direction();
    }
}

$journey->followDirection($direction);

echo "
  Final coordinate distance from start:           {$journey->getCurrentDistanceFromStart()}
  First revisited coordinate distance from start: {$journey->getFirstRevisitedCoordinateDistanceFromStart()}
";

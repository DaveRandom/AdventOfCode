#!/usr/bin/env php
<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2015\Day1;

use DaveRandom\AdventOfCode\Utils\ByteStreamIterator;

require __DIR__ . '/../../../vendor/autoload.php';

$iterator = ByteStreamIterator::fromInput();

$position = [0, 0];
$visitedSolo = ['0/0' => 1];

foreach ($iterator as $byte) {
    $action = ['^' => 0, '>' => 1, 'v' => 2, '<' => 3][$byte];
    $position[$action & 0b01] += ($action & 0b10) ? -1 : 1;

    $key = "{$position[0]}/{$position[1]}";

    if (isset($visitedSolo[$key])) {
        $visitedSolo[$key]++;
    } else {
        $visitedSolo[$key] = 1;
    }
}

$totalVisitedSolo = count($visitedSolo);

$positions = [[0, 0], [0, 0]];
$visitedRobo = ['0/0' => 1];

foreach ($iterator as $i => $byte) {
    $mover = $i % 2;
    $action = ['^' => 0, '>' => 1, 'v' => 2, '<' => 3][$byte];
    $positions[$mover][$action & 0b01] += ($action & 0b10) ? -1 : 1;

    $key = "{$positions[$mover][0]}/{$positions[$mover][1]}";

    if (isset($visitedRobo[$key])) {
        $visitedRobo[$key]++;
    } else {
        $visitedRobo[$key] = 1;
    }
}

$totalVisitedRobo = count($visitedRobo);

echo "
  Total visited (solo): {$totalVisitedSolo} houses
  Total visited (robo): {$totalVisitedRobo} houses
";

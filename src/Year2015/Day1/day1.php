#!/usr/bin/env php
<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2015\Day1;

use DaveRandom\AdventOfCode\Utils\ByteStreamIterator;

require __DIR__ . '/../../../vendor/autoload.php';

$pos = 0;
$basementPos = -1;

foreach (ByteStreamIterator::fromInput() as $i => $byte) {
    $pos += ['(' => 1, ')' => -1][$byte] ?? 0;

    if ($basementPos === -1 && $pos === -1) {
        $basementPos = $i + 1;
    }
}

echo "
  Final position:       {$pos}
  First basement entry: {$basementPos}
";

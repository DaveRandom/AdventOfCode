#!/usr/bin/env php
<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2015\Day1;

use DaveRandom\AdventOfCode\Utils\LineStreamIterator;

require __DIR__ . '/../../../vendor/autoload.php';

$niceStrings = 0;

foreach (LineStreamIterator::fromInput() as $line) {
    if (!preg_match('/([a-z])\1/', $line) || preg_match('/ab|cd|pq|xy/', $line)) {
        continue;
    }

    $vowels = 0;

    for ($i = 0, $l = strlen($line); $i < $l; $i++) {
        if (in_array($line[$i], ['a', 'e', 'i', 'o', 'u'])) {
            $vowels++;
        }
    }

    if ($vowels >= 3) {
        $niceStrings++;
    }
}

echo "
  Nice strings: {$niceStrings}
";

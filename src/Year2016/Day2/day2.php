#!/usr/bin/env php
<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2016\Day1;

use DaveRandom\AdventOfCode\Utils\LineStreamIterator;

require __DIR__ . '/../../../vendor/autoload.php';

$buttons = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
];

$pos = [1, 1];

$codeSquare = '';

foreach (LineStreamIterator::fromInput() as $line) {
    for ($i = 0, $l = strlen($line); $i < $l; $i++) {
        switch ($line[$i]) {
            case 'D':
                $pos[0] = min($pos[0] + 1, 2);
                break;
            case 'R':
                $pos[1] = min($pos[1] + 1, 2);
                break;
            case 'U':
                $pos[0] = max($pos[0] - 1, 0);
                break;
            case 'L':
                $pos[1] = max($pos[1] - 1, 0);
                break;
        }
    }

    $codeSquare .= $buttons[$pos[0]][$pos[1]];
}

const A = 'A';
const B = 'B';
const C = 'C';
const D = 'D';

$buttons = [
    [0, 0, 1, 0, 0],
    [0, 2, 3, 4, 0],
    [5, 6, 7, 8, 9],
    [0, A, B, C, 0],
    [0, 0, D, 0, 0],
];

$pos = [2, 0];

$codeDiamond = '';

foreach (LineStreamIterator::fromInput() as $line) {
    for ($i = 0, $l = strlen($line); $i < $l; $i++) {
        switch ($line[$i]) {
            case 'D':
                if (!empty($buttons[$pos[0] + 1][$pos[1]])) {
                    $pos[0]++;
                }
                break;
            case 'R':
                if (!empty($buttons[$pos[0]][$pos[1] + 1])) {
                    $pos[1]++;
                }
                break;
            case 'U':
                if (!empty($buttons[$pos[0] - 1][$pos[1]])) {
                    $pos[0]--;
                }
                break;
            case 'L':
                if (!empty($buttons[$pos[0]][$pos[1] - 1])) {
                    $pos[1]--;
                }
                break;
        }
    }

    $codeDiamond .= $buttons[$pos[0]][$pos[1]];
}

echo "
  Door code square:  {$codeSquare}
  Door code diamond: {$codeDiamond}
";

#!/usr/bin/env php
<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2015\Day1;

use DaveRandom\AdventOfCode\Utils\LineStreamIterator;

require __DIR__ . '/../../../vendor/autoload.php';

$wrapping = $ribbon = 0;

foreach (LineStreamIterator::fromInput() as $line) {
    list($l, $w, $h) = array_map('intval', explode('x', $line));

    $lw = $l * $w;
    $wh = $w * $h;
    $hl = $h * $l;

    $max = max($l, $w, $h);

    if ($l === $max) {
        $smallestPerimeter = ($w * 2) + ($h * 2);
    } else if ($w === $max) {
        $smallestPerimeter = ($l * 2) + ($h * 2);
    } else {
        $smallestPerimeter = ($l * 2) + ($w * 2);
    }

    $volume = $l * $w * $h;

    $wrapping += ($lw * 2) + ($wh * 2) + ($hl * 2) + min($lw, $wh, $hl);
    $ribbon += $smallestPerimeter + $volume;
}

echo "
  Total wrapping required: {$wrapping} sq. ft
  Total ribbon required:   {$ribbon} ft
";

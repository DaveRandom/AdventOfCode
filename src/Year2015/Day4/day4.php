#!/usr/bin/env php
<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2015\Day1;

use DaveRandom\AdventOfCode\Utils\App;

require __DIR__ . '/../../../vendor/autoload.php';

$key = App::getInputAsString();

$i = 0;

do {
    $i++;
} while (substr(md5($key . $i), 0, 5) !== '00000');

$j = 0;

do {
    $j++;
} while (substr(md5($key . $j), 0, 6) !== '000000');

echo "
  First match (5): $i
  First match (6): $j
";

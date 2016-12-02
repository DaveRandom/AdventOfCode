<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2016\Day1;

class Direction
{
    const TURN_RIGHT = 1;
    const TURN_LEFT = -1;

    private $turn;
    private $distance;

    public function __construct(string $spec)
    {
        $this->turn = ['R' => self::TURN_RIGHT, 'L' => self::TURN_LEFT][$spec[0]];
        $this->distance = (int)substr($spec, 1);
    }

    public function getTurn(): int
    {
        return $this->turn;
    }

    public function getDistance(): int
    {
        return $this->distance;
    }
}

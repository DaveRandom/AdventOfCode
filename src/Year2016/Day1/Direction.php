<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2016\Day1;

class Direction
{
    const TURN_RIGHT = 1;
    const TURN_LEFT = -1;

    private $turn;
    private $distance = '';

    public function addChar(string $char)
    {
        static $turns = ['R' => self::TURN_RIGHT, 'L' => self::TURN_LEFT];

        if (in_array($char, [' ', "\r", "\n", "\t"])) {
            return;
        }

        if (!isset($this->turn)) {
            $this->turn = $turns[$char];
        } else {
            $this->distance .= $char;
        }
    }

    public function getTurn(): int
    {
        return $this->turn;
    }

    public function getDistance(): int
    {
        return (int)$this->distance;
    }
}

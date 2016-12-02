<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Year2016\Day1;

class Journey
{
    private $bearing = 0;
    private $currentCoordinates = [0, 0];

    private $moves = 0;

    private $coordinateFirstVisits = [];
    private $coordinateLastVisits = [];

    private static function getCoordinateKey(array $coordinate)
    {
        return "{$coordinate[0]}/{$coordinate[1]}";
    }

    private static function parseCoordinateKey(string $key)
    {
        return array_map('intval', explode('/', $key));
    }

    private static function getCoordinateDistanceFromStart(array $coordinate)
    {
        return abs($coordinate[0]) + abs($coordinate[1]);
    }

    public function followDirection(Direction $direction)
    {
        $this->moves++;

        $this->bearing = 0b11 & ($this->bearing + $direction->getTurn());

        $dimension = $this->bearing & 0b01;
        $increment = $this->bearing > 1 ? -1 : 1;

        for ($i = 0, $l = $direction->getDistance(); $i < $l; $i++) {
            $this->currentCoordinates[$dimension] += $increment;

            $key = self::getCoordinateKey($this->currentCoordinates);

            $this->coordinateLastVisits[$key] = $this->moves;

            if (!isset($this->coordinateFirstVisits[$key])) {
                $this->coordinateFirstVisits[$key] = $this->moves;
            }
        }
    }

    public function getCurrentDistanceFromStart()
    {
        return self::getCoordinateDistanceFromStart($this->currentCoordinates);
    }

    public function getFirstRevisitedCoordinateDistanceFromStart()
    {
        foreach ($this->coordinateFirstVisits as $key => $move) {
            if ($this->coordinateLastVisits[$key] !== $move) {
                return self::getCoordinateDistanceFromStart(self::parseCoordinateKey($key));
            }
        }

        throw new \Exception('No coordinates were revisited');
    }
}

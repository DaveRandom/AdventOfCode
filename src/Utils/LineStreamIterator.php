<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Utils;

class LineStreamIterator extends StreamIterator
{
    private $buffer;

    public function current()
    {
        return rtrim($this->buffer);
    }

    public function next()
    {
        parent::next();

        $this->buffer = fgets($this->stream);
    }

    public function valid()
    {
        return $this->buffer !== false;
    }

    public function rewind()
    {
        parent::rewind();

        $this->buffer = fgets($this->stream);
    }
}

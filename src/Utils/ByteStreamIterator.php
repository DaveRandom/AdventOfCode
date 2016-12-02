<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Utils;

class ByteStreamIterator extends StreamIterator
{
    private $buffer;

    public function __construct($stream, $flags = self::IGNORE_TERMINATING_EOL)
    {
        parent::__construct($stream, $flags);
    }

    public function current()
    {
        return array_shift($this->buffer);
    }

    public function next()
    {
        parent::next();

        if (false !== $char = fgetc($this->stream)) {
            $this->buffer[] = $char;
        }
    }

    public function valid()
    {
        return !(empty($this->buffer)
            || (($this->flags & self::IGNORE_TERMINATING_EOL) && ($this->buffer === ["\n"] || $this->buffer === ["\r", "\n"])));
    }

    public function rewind()
    {
        parent::rewind();

        $this->buffer = [];

        for ($i = 0; $i < 3 && false !== $char = fgetc($this->stream); $i++) {
            $this->buffer[] = $char;
        }
    }
}

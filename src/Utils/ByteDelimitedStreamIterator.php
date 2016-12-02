<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Utils;

class ByteDelimitedStreamIterator extends StreamIterator
{
    private $delimiter;

    public function __construct($stream, string $delimiter, int $flags = self::IGNORE_WHITESPACE)
    {
        parent::__construct($stream, $flags);

        $this->delimiter = $delimiter[0];
    }

    public function current()
    {
        $value = '';

        while (false !== $byte = fgetc($this->stream)) {
            if ($byte === $this->delimiter) {
                return $value;
            }

            if (($this->flags & self::IGNORE_WHITESPACE) && preg_match('/\s/', $byte)) {
                continue;
            }

            $value .= $byte;
        }

        return $value;
    }
}

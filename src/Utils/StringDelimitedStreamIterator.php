<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Utils;

class StringDelimitedStreamIterator extends StreamIterator
{
    private $delimiter;
    private $length;

    public function __construct($stream, string $delimiter, int $flags = self::IGNORE_WHITESPACE)
    {
        parent::__construct($stream, $flags);

        $this->delimiter = $delimiter;
        $this->length = strlen($delimiter);
    }

    public function current()
    {
        $value = '';

        while (false !== $byte = fgetc($this->stream)) {
            $value .= $byte;

            if (substr_compare($value, $this->delimiter, -$this->length, $this->length) === 0) {
                return trim($value);
            }
        }

        return trim($value);
    }
}

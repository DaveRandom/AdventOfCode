<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Utils;

abstract class StreamIterator implements \Iterator
{
    const IGNORE_WHITESPACE      = 0x00000001;
    const IGNORE_TERMINATING_EOL = 0x00000002;

    protected $stream;
    protected $flags;

    private $key = 0;

    public static function fromInput(...$args)
    {
        return new static(App::getInputAsStream(), ...$args);
    }

    public function __construct($stream, int $flags = 0)
    {
        $this->stream = $stream;
        $this->flags = $flags;
    }

    abstract public function current();

    public function next()
    {
        $this->key++;
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        return !feof($this->stream);
    }

    public function rewind()
    {
        rewind($this->stream);
    }

    public function map(callable $callback): array
    {
        $result = [];

        foreach ($this as $key => $value) {
            $result[] = $callback($key, $value);
        }

        return $result;
    }
}

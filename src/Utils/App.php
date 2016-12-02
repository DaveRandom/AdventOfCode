<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode\Utils;

class App
{
    const HELP_TEMPLATE = /** @lang text */ '

  Syntax:
    %1$s <input file>
    %1$s -i <input string>
';

    const ERROR_TEMPLATE = /** @lang text */ '

  Error: %s
';

    private static $initialised = false;
    private static $argv;

    private static function showHelpAndExit()
    {
        fwrite(STDOUT, sprintf(self::HELP_TEMPLATE, self::$argv[0]) . PHP_EOL);
        exit(0);
    }

    private static function showErrorAndExit(string $error)
    {
        fwrite(STDERR, sprintf(self::ERROR_TEMPLATE, $error) . sprintf(self::HELP_TEMPLATE, self::$argv[0]) . PHP_EOL);
        exit(1);
    }

    public static function init()
    {
        if (self::$initialised) {
            return;
        }

        self::$argv = $GLOBALS['argv'];

        if (!isset(self::$argv[1]) || in_array(self::$argv, ['-h', '--help', '/?', '?'])) {
            self::showHelpAndExit();
        }

        self::$initialised = true;
    }

    public static function getInputAsString()
    {
        return stream_get_contents(self::getInputAsStream());
    }

    public static function getInputAsStream()
    {
        self::init();

        if (self::$argv[1] === '-i') {
            if (!isset(self::$argv[2])) {
                self::showErrorAndExit("Input string not specified");
            }

            $fp = fopen('php://temp', 'w+');
            fwrite($fp, self::$argv[2]);
            rewind($fp);

            return $fp;
        }

        if (!is_file(self::$argv[1]) || !is_readable(self::$argv[1])) {
            self::showErrorAndExit("Invalid input file");
        }

        if (!$fp = fopen(self::$argv[1], 'r')) {
            self::showErrorAndExit("Failed opening input file");
        }

        return $fp;
    }
}

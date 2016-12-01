<?php declare(strict_types = 1);

namespace DaveRandom\AdventOfCode;

const HELP_TEMPLATE = /** @lang text */ '

  Syntax:
    %1$s <input file>
    %1$s -i <input string>
';

const ERROR_TEMPLATE = /** @lang text */ '

  Error: %s
';

function help_exit()
{
    global $argv;

    fwrite(STDOUT, sprintf(HELP_TEMPLATE, $argv[0]) . PHP_EOL);
    exit(0);
}

function error_exit($error)
{
    global $argv;

    fwrite(STDERR, sprintf(ERROR_TEMPLATE, $error) . sprintf(HELP_TEMPLATE, $argv[0]) . PHP_EOL);
    exit(1);
}

function app_init()
{
    global $argv;

    if (!isset($argv[1]) || $argv[1] === '-h' || $argv[1] === '--help' || $argv[1] === '/?' || $argv[1] === '?') {
        help_exit();
    }

    if ($argv[1] === '-i') {
        if (!isset($argv[2])) {
            error_exit("Input string not specified");
        }

        $fp = fopen('php://temp', 'w+');
        fwrite($fp, $argv[2]);
        rewind($fp);

        return $fp;
    }

    if (!is_file($argv[1]) || !is_readable($argv[1])) {
        error_exit("Invalid input file");
    }

    if (!$fp = fopen($argv[1], 'r')) {
        error_exit("Failed opening input file");
    }

    return $fp;
}

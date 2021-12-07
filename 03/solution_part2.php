<?php

// https://adventofcode.com/2021/day/3

require __DIR__ . '/../utils.inc.php';

if ($argc < 2) {
    echo "Error:The data input filename is the required argument.\n";
    echo "Usage:
    php solution_part1.php <input_filename>
    \n";
    die();
}

$input = loadInput($argv[1]);

$o2 = reduce($input, 0, true);
$co2 = reduce($input, 0, false);

echo "O2: $o2, CO2: $co2\n";

echo "SOLUTION: ", ($o2 * $co2), "\n";


/**
 * @param  string[]  $input
 * @param  int       $position
 * @param  bool      $lookForMostCommon
 *
 * @return int
 */
function reduce(array $input, int $position, bool $lookForMostCommon): int
{
    echo "\n----\nPosition: $position\n";
    print_r($input);

    if ($position >= strlen($input[0])) {
        die("We failed to find the match.\n");
    }

    $bit = getMostCommon($input, $position);

    if (! $lookForMostCommon) {
        $bit = ($bit === '1') ? '0' : '1';
    }

    echo "Looking for {$bit}s\n";

    $left = array_filter($input, function ($row) use ($position, $bit) {
        return $row[$position] === $bit;
    });

    // reindex the array
    $left = array_values($left);

    if (empty($left)) {
        die("No match.\n");
    }

    if (count($left) === 1) {
        echo "Result is $left[0]\n";
        return bindec($left[0]);
    }

    return reduce($left, $position + 1, $lookForMostCommon);
}

/**
 * @param  string[]  $input     Input array
 * @param  int       $position  The bit position
 *
 * @return string
 */
function getMostCommon(array $input, int $position): string
{
    $ones = 0;

    foreach ($input as $row) {
        if ($row[$position] === '1') {
            $ones++;
        }
    }

    $middle = count($input)/2;

    return ($ones >= $middle) ? '1' : '0';
}
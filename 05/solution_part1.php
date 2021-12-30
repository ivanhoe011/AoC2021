<?php

// https://adventofcode.com/2021/day/5

require __DIR__ . '/../utils.inc.php';

if ($argc < 2) {
    echo "Error:The data input filename is the required argument.\n";
    echo "Usage:
    php solution_part1.php <input_filename>
    \n";
    die();
}

$input = loadInput($argv[1]);

$map = [];

foreach ($input as $line) {
    [$x1, $y1, $x2, $y2] = getCoords($line);

    if ($x1 === $x2) {
        makeVertLine($map, $x1, $y1, $y2);

    } elseif ($y1 === $y2) {
        makeHorizLine($map, $y1, $x1, $x2);
    }

    // else do nothing, we ignore other lines
}

$cnt = 0;

foreach ($map as $x => $line) {
    foreach ($line as $y => $value) {
        if ($value > 1) {
            $cnt++;
            echo "($x, $y) -> $value\n";
        }
    }
}

echo "Solution: $cnt\n";

function getCoords(string $line): array
{
    preg_match('/\s*([0-9]+),([0-9]+)\s+->\s+([0-9]+),([0-9]+)\s*/', $line, $matches);

    return array_slice($matches, 1);
}

function makeVertLine(array &$map, int $x, int $y1, int $y2): void
{
    $start = min($y1, $y2);
    $end = max($y1, $y2);

    if ( ! isset($map[$x])) {
        $map[$x] = [];
    }

    for ($i = $start; $i <= $end; $i++) {
        $map[$x][$i] = empty($map[$x][$i]) ? 1 : $map[$x][$i] + 1;
    }
}

function makeHorizLine(array &$map, int $y, int $x1, int $x2): void
{
    $start = min($x1, $x2);
    $end = max($x1, $x2);

    for ($i = $start; $i <= $end; $i++) {
        if ( ! isset($map[$i])) {
            $map[$i] = [
                $y => 1,
            ];
        } else {
            $map[$i][$y] = empty($map[$i][$y]) ? 1 : $map[$i][$y] + 1;
        }
    }
}
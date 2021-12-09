<?php

// https://adventofcode.com/2021/day/4

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

    } elseif (abs($x2 - $x1) === abs($y2 - $y1)) {
        makeDiagonalLine($map, $x1, $x2, $y1, $y2);

    } else {
        die("Line is not horizontal, vertical, nor diagonal.\n");
    }
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

function makeDiagonalLine(array &$map, int $x1, int $x2, int $y1, int $y2): void
{
    for ($i = 0; $i <= abs($x2 - $x1); $i++) {
        $x = $x1 + ($x1 < $x2 ? $i : -$i);
        $y = $y1 + ($y1 < $y2 ? $i : -$i);

        if ( ! isset($map[$x])) {
            $map[$x] = [
                $y => 1,
            ];
        } else {
            $map[$x][$y] = empty($map[$x][$y]) ? 1 : $map[$x][$y] + 1;
        }
    }
}
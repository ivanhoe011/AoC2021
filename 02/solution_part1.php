<?php

// https://adventofcode.com/2021/day/2

// Calculate the horizontal position and depth you would have after following
// the planned course. What do you get if you multiply your final horizontal
// position by your final depth?

$input = file(__DIR__ . '/input.txt');

$x = 0;
$depth = 0;

foreach ($input as $command) {

    [$direction, $distance] = explode(' ', trim($command));

    switch ($direction) {
        case 'forward':
            $x += (int) $distance;
            break;

        case 'up':
            $depth -= (int) $distance;
            break;

        case 'down':
            $depth += (int) $distance;
            break;

        default:
            die("Unknown direction.\n");
    }

    // echo "$command: X: $x, Depth: $depth\n";
}

echo 'SOLUTION: ', ($x * $depth), "\n";
<?php

// https://adventofcode.com/2021/day/2#part2

// Using this new interpretation of the commands, calculate the horizontal
// position and depth you would have after following the planned course. What
// do you get if you multiply your final horizontal position by your final
// depth?

$input = file(__DIR__ . '/input.txt');

$x = 0;
$depth = 0;
$aim = 0;

foreach ($input as $command) {

    [$direction, $distance] = explode(' ', trim($command));

    switch ($direction) {
        case 'forward':
            $x += (int) $distance;
            $depth += $aim * $distance;
            break;

        case 'up':
            $aim -= (int) $distance;
            break;

        case 'down':
            $aim += (int) $distance;
            break;

        default:
            die("Unknown direction.\n");
    }

    // echo trim($command), ": X: $x, Aim: $aim, Depth: $depth\n";
}

echo 'SOLUTION: ', ($x * $depth), "\n";
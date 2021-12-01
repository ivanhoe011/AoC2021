<?php

// https://adventofcode.com/2021/day/1#part2

// Consider sums of a three-measurement sliding window. Your goal now is to
// count the number of times the sum of measurements in this sliding window
// increases from the previous sum.

$input = file(__DIR__ . '/input.txt');
$incCount = 0;

$prevSum = $input[0] + $input[1] + $input[2];

for ($i = 3; $i < count($input); $i++) {

    $sum = $input[$i - 2] + $input[$i - 1] + $input[$i];

    if ($sum > $prevSum) {
        $incCount++;
    }

    $prevSum = $sum;
}

echo "Solution: {$incCount}\n";
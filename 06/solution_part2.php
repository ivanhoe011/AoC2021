<?php

// https://adventofcode.com/2021/day/6

require __DIR__ . '/../utils.inc.php';

if ($argc < 3) {
    echo "Error:The data input filename and days number are the required arguments.\n";
    echo "Usage:
    php solution_part1.php <input_filename> <days>
    \n";
    die();
}

$input = loadSequence($argv[1], ',');
$days = $argv[2];

$fish = array_fill(0, 9, 0);

foreach ($input as $value) {
    $fish[$value]++;
}

while($days--) {
    $state = [];

    for ($i = 1; $i <= 8; $i++) {
        $state[$i-1] = $fish[$i];
    }

    $state[8] = $fish[0]; // new fish
    $state[6] +=  $fish[0]; // reset counting

    $fish = $state;

    echo 'Day #', (80 - $days), ': ', implode(',', $fish), "\n";
}

echo "Solution: ", array_sum($fish), "\n";

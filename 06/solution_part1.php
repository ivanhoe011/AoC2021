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

while($days--) {

    $cnt = count($input);

    for ($i = 0; $i < $cnt; $i++) {
        $input[$i]--;

        if ($input[$i] < 0) {
            $input[$i] = 6;
            $input[] = 8;
        }
    }

    //echo 'Day #', (80 - $days), ': ', implode(',', $input), "\n";
}

echo "Solution: ", count($input), "\n";


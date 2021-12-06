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

// how many bits the binary words in the input are long
$binWordSize = strlen(trim($input[1]));

$cnt = 0;
$bits = array_fill(0, $binWordSize, 0);

foreach ($input as $bin) {

    // count 1s in the input
    for ($i = 0; $i < $binWordSize; $i++) {
        if ($bin[$i] === '1') {
            $bits[$i]++;
        }
    }

    // total number of lines in the input
    $cnt++;
}

$gamma = 0;
$epsilon = 0;

// find the most common value for each bit
for ($i = 0; $i < $binWordSize; $i++) {
    // bit positions are little endian
    $position = $binWordSize - $i - 1;

    // check if more than a half of rows had 1 (is it the most common value)
    $bits[$i] > $cnt/2
        // set the bit at that position
        ? $gamma |= 1 << $position
        : $epsilon |= 1 << $position;
}

print_r($bits);
echo "Rows total: $cnt\n";
echo 'Gamma: ', decbin($gamma), ', Epsilon: ', decbin($epsilon), "\n";

echo "SOLUTION: ", ($gamma * $epsilon), "\n";
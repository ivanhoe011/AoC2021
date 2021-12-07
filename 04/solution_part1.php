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

$input = array_map('trim', loadInput($argv[1]));

$numbers = explode(',', array_shift($input));

$input = array_filter($input); // removes empty lines

$boards = [];
$cnt = 0;

do {
    for ($i = 0; $i < 5; $i++) {
        // linearize the boards, row by row
        $boards[$cnt] = array_merge($boards[$cnt] ?? [], preg_split('/\s+/', array_shift($input)));
    }

    $cnt++;
} while (count($input));

echo "Numbers: ", implode(' ', $numbers), "\n";
echo "Found $cnt boards.\n";
print_r($boards);

$matchCol = [];
$matchRow = [];

foreach ($numbers as $ord => $num) {
    echo "Searching for number $num\n";

    foreach($boards as $i => &$board) {
        echo "BOARD #{$i}: ";
        print_r($board);

        $index = array_search($num, $board);

        if ($index === false) {
            echo "Not found on board #{$i}, continue...\n";
            continue;
        }

        // else we have a match

        // remove the matched number
        unset($board[$index]);

        echo "BOARD #{$i} after delete of item[$index]: ";
        print_r($board);

        // get coordinates from the index
        [$col, $row] = calcPosition($index);

        echo "Found at board #{$i}: index $index --> $row row, $col column.\n";

        if (! isset($matchCol[$i])) {
            $matchCol[$i] = [];
        }

        if (! isset($matchRow[$i])) {
            $matchRow[$i] = [];
        }

        // increase the counter of matches
        $matchCol[$i][$col] = isset($matchCol[$i][$col]) ? $matchCol[$i][$col] + 1 : 1;
        $matchRow[$i][$row] = isset($matchRow[$i][$row]) ? $matchRow[$i][$row] + 1 : 1;

        echo "Counters for board #{$i}: column $col - {$matchCol[$i][$col]}, row $row - {$matchRow[$i][$row]}\n";
/*
        echo "COL matches:";
        print_r($matchCol);

        echo "ROW matches:";
        print_r($matchRow);
*/
        // if it's 5
        if ($matchCol[$i][$col] === 5 || $matchRow[$i][$row] === 5) {
            echo "Board #{$i} wins.\n\n";
            $score = calcScore($board, $num);
            echo "Solution: $score\n";
            exit;
        }
    }
}

function calcScore(array $board, int $number): int
{
    echo "BOARD:";
    print_r($board);

    $sum = array_reduce($board, function(int $acc , int $item): int { return $acc + $item; }, 0);

    echo "SUM OF THE BOARD: $sum\n";

    echo "SCORE (sum x number): $sum x $number = ", ($sum * $number), "\n";
    return $sum * $number;
}

function calcPosition(int $index): array
{
    $col = $index % 5;
    $row = (int) ($index / 5);

    return [$col, $row];
}
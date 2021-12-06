<?php

function loadInput(string $fullPath): array
{
    if (! file_exists($fullPath)) {
        die ("Input file not found: '$fullPath'.\n");
    }

    return file($fullPath);
}
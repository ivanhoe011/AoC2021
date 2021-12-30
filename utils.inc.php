<?php

function loadInput(string $filename): array
{
    if (! file_exists($filename)) {
        die ("Input file '$filename' not found in '" . __DIR__ ."'\n");
    }

    return file($filename);
}

function loadSequence(string $filename, string $separator): array
{
    if (! file_exists($filename) || ! ($txt = file_get_contents($filename))) {
        die ("Input file '$filename' not found in '" . __DIR__ ."'\n");
    }

    return explode($separator, trim($txt));
}
<?php

function loadInput(string $filename): array
{
    if (! file_exists($filename)) {
        die ("Input file '$filename' not found in '" . __DIR__ ."'\n");
    }

    return file($filename);
}
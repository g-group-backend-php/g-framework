<?php

namespace App\Service;

/**
 * Klasa ta to oczywiście przerost formy nad treścią, ale chcieliśmy, by GlobeService miał jakąś zależność
 */
class ArrayService
{
    public function makeArray(string $key, string $value): array
    {
        return [$key => $value];
    }
}

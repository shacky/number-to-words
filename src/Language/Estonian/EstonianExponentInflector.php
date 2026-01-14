<?php

namespace NumberToWords\Language\Estonian;

use NumberToWords\Language\ExponentInflector;

class EstonianExponentInflector implements ExponentInflector
{
    private static array $exponents = [
        0 => '',
        1 => 'tuhat',
        2 => 'miljon',
        3 => 'miljard',
        4 => 'triljon',
    ];

    public function inflectExponent(int $number, int $power): string
    {
        $exponent = self::$exponents[$power] ?? '';

        // Add plural suffix "it" for numbers > 1, except for thousands (power 1)
        if ($number != 1 && $power != 1 && $exponent !== '') {
            $exponent .= 'it';
        }

        return $exponent;
    }
}

<?php

namespace NumberToWords\Language\BelgianFrench;

use NumberToWords\Language\ExponentInflector;

class BelgianFrenchExponentInflector implements ExponentInflector
{
    private static array $exponents = [
        0 => '',
        3 => 'mille',
        6 => 'million',
        9 => 'milliard',
        12 => 'trillion',
        15 => 'quadrillion',
        18 => 'quintillion',
        21 => 'sextillion',
        24 => 'septillion',
        27 => 'octillion',
        30 => 'nonillion',
        33 => 'decillion',
        36 => 'undecillion',
        39 => 'duodecillion',
        42 => 'tredecillion',
        45 => 'quattuordecillion',
        48 => 'quindecillion',
        51 => 'sexdecillion',
        54 => 'septendecillion',
        57 => 'octodecillion',
        60 => 'novemdecillion',
        63 => 'vigintillion',
        66 => 'unvigintillion',
        69 => 'duovigintillion',
        72 => 'trevigintillion',
        75 => 'quattuorvigintillion',
        78 => 'quinvigintillion',
        81 => 'sexvigintillion',
        84 => 'septenvigintillion',
        87 => 'octovigintillion',
        90 => 'novemvigintillion',
    ];

    public function inflectExponent(int $number, int $power): string
    {
        $exponent = self::$exponents[$power * 3] ?? '';

        // Add plural 's' for millions, billions, etc. (but not for "mille")
        if ($power > 1 && $number > 1 && $exponent !== '') {
            $exponent .= 's';
        }

        return $exponent;
    }
}

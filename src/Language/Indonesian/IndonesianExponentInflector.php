<?php

namespace NumberToWords\Language\Indonesian;

use NumberToWords\Language\ExponentInflector;

class IndonesianExponentInflector implements ExponentInflector
{
    private static array $exponents = [
        0 => '',
        1 => 'ribu',
        2 => 'juta',
        3 => 'miliar',
        4 => 'triliun',
        8 => 'kuadriliun',
        10 => 'kuintiliun',
        12 => 'sekstiliun',
        14 => 'septiliun',
        16 => 'oktiliun',
        18 => 'noniliun',
        20 => 'desiliun',
        22 => 'undesiliun',
    ];

    public function inflectExponent(int $number, int $power): string
    {
        if ($power === 0) {
            return '';
        }

        if ($power === 1 && $number === 1) {
            return 'seribu';
        }

        return self::$exponents[$power] ?? '';
    }
}

<?php

namespace NumberToWords\Language\Malay;

use NumberToWords\Language\ExponentInflector;

class MalayExponentInflector implements ExponentInflector
{
    private static array $exponents = [
        0 => '',
        1 => 'ribu',
        2 => 'juta',
        3 => 'bilion',
        4 => 'trilion',
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

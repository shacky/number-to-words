<?php

namespace NumberToWords\Language\Turkish;

use NumberToWords\Language\ExponentGetter;

class TurkishExponentGetter implements ExponentGetter
{
    private static array $exponents = [
        0 => '',
        1 => 'bin',
        2 => 'milyon',
        3 => 'milyar',
        4 => 'trilyon',
        5 => 'katrilyon',
    ];

    public function getExponent(int $power): string
    {
        return self::$exponents[$power] ?? '';
    }
}

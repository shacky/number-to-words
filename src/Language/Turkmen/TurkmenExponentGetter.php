<?php

namespace NumberToWords\Language\Turkmen;

use NumberToWords\Language\ExponentGetter;

class TurkmenExponentGetter implements ExponentGetter
{
    private static array $exponents = [
        0 => '',
        1 => 'müň',
        2 => 'million',
        3 => 'milliard',
        4 => 'trillion',
    ];

    public function getExponent(int $power): string
    {
        return self::$exponents[$power] ?? '';
    }
}

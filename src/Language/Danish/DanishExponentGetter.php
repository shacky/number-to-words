<?php

namespace NumberToWords\Language\Danish;

use NumberToWords\Language\ExponentGetter;

class DanishExponentGetter implements ExponentGetter
{
    private static array $exponents = [
        0 => '',
        1 => 'tusind',
        2 => 'million',
        3 => 'milliard',
        4 => 'billion',
    ];

    public function getExponent(int $power): string
    {
        return self::$exponents[$power] ?? '';
    }
}

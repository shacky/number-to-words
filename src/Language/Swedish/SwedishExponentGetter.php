<?php

namespace NumberToWords\Language\Swedish;

use NumberToWords\Language\ExponentGetter;

class SwedishExponentGetter implements ExponentGetter
{
    private static array $exponents = [
        0 => '',
        1 => 'tusen',
        2 => 'miljon',
        3 => 'miljard',
        4 => 'biljon',
    ];

    public function getExponent(int $power): string
    {
        return self::$exponents[$power] ?? '';
    }
}

<?php

namespace NumberToWords\Language\Italian;

use NumberToWords\Language\ExponentInflector;

class ItalianExponentInflector implements ExponentInflector
{
    private const EXPONENTS = [
        0 => ['', ''],
        1 => ['mille', 'mila'],                       // 10^3 = thousand (no spaces)
        2 => [' milione ', ' milioni '],              // 10^6 = million (with spaces)
        3 => [' miliardo ', ' miliardi '],            // 10^9 = billion (with spaces)
        4 => [' bilione ', ' bilioni '],              // 10^12 = trillion (with spaces)
        5 => [' biliardo ', ' biliardi '],            // 10^15 (with spaces)
        6 => [' trilione ', ' trilioni '],            // 10^18 (with spaces)
    ];

    public function inflectExponent(int $number, int $power): string
    {
        if (!isset(self::EXPONENTS[$power])) {
            return '';
        }

        $forms = self::EXPONENTS[$power];

        // For all exponents: 1 = singular, otherwise = plural
        if ($number === 1) {
            return $forms[0];
        }

        return $forms[1];
    }
}

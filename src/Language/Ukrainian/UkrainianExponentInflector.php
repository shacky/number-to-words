<?php

namespace NumberToWords\Language\Ukrainian;

use NumberToWords\Language\ExponentInflector;

class UkrainianExponentInflector implements ExponentInflector
{
    private static array $exponents = [
        // [singular, dual (2-4), plural (5+)]
        0 => ['', '', ''],
        1 => ['тисяча', 'тисячі', 'тисяч'],
        2 => ['мільйон', 'мільйони', 'мільйонів'],
        3 => ['мільярд', 'мільярди', 'мільярдів'],
        4 => ['трильйон', 'трильйони', 'трильйонів'],
    ];

    public function inflectExponent(int $number, int $power): string
    {
        if ($power === 0 || !isset(self::$exponents[$power])) {
            return '';
        }

        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;

        // Numbers ending in 1 (but not 11) use singular form
        if ($units === 1 && $tens !== 1) {
            return self::$exponents[$power][0];
        }

        // Numbers ending in 2-4 (but not 12-14) use dual form
        if ($units >= 2 && $units <= 4 && $tens !== 1) {
            return self::$exponents[$power][1];
        }

        // All other numbers use plural form
        return self::$exponents[$power][2];
    }
}

<?php

namespace NumberToWords\Language\Spanish;

use NumberToWords\Language\ExponentInflector;

class SpanishExponentInflector implements ExponentInflector
{
    private static array $exponents = [
        // Spanish uses long scale: billion = 10^12, not 10^9
        // Triplets come in powers: 0, 1 (10^3), 2 (10^6), 3 (10^9), 4 (10^12)...
        0 => ['', ''],
        1 => ['mil', 'mil'],              // 10^3 = thousand
        2 => ['millón', 'millones'],      // 10^6 = million
        3 => ['mil', 'mil'],              // 10^9 = "mil" in context (should be "mil millones" standalone but that's complex)
        4 => ['billón', 'billones'],      // 10^12 = billion (long scale)
        5 => ['mil', 'mil'],
        6 => ['trilón', 'trillones'],     // 10^18 = trillion (long scale)
    ];

    public function inflectExponent(int $number, int $power): string
    {
        if ($power === 0 || !isset(self::$exponents[$power])) {
            return '';
        }

        // For "mil" (thousands and intermediate powers), always use the same form
        if ($power === 1 || $power === 3 || $power === 5) {
            return self::$exponents[$power][0];
        }

        // For millions and billions, use singular if exactly 1, otherwise plural
        if ($number === 1) {
            return self::$exponents[$power][0];
        }

        return self::$exponents[$power][1];
    }
}

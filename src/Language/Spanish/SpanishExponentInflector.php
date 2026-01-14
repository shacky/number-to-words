<?php

namespace NumberToWords\Language\Spanish;

use NumberToWords\Language\PowerAwareExponentInflector;

class SpanishExponentInflector implements PowerAwareExponentInflector
{
    private static array $exponents = [
        // Spanish uses long scale: billion = 10^12, not 10^9
        // Triplets come in powers: 0, 1 (10^3), 2 (10^6), 3 (10^9), 4 (10^12)...
        0 => ['', ''],
        1 => ['mil', 'mil'],              // 10^3 = thousand
        2 => ['millón', 'millones'],      // 10^6 = million
        3 => ['mil millones', 'mil millones'], // 10^9 = thousand millions (when standalone)
        4 => ['billón', 'billones'],      // 10^12 = billion (long scale)
        5 => ['mil billones', 'mil billones'],
        6 => ['trilón', 'trillones'],     // 10^18 = trillion (long scale)
    ];

    public function inflectExponent(int $number, int $power): string
    {
        // Fallback for backward compatibility - assume only one triplet
        return $this->inflectExponentWithContext($number, $power, $power, 1);
    }

    public function inflectExponentWithContext(int $number, int $power, int $maxPower, int $nonZeroTripletCount): string
    {
        if ($power === 0 || !isset(self::$exponents[$power])) {
            return '';
        }

        // For "mil" (thousands), always use the same form
        if ($power === 1) {
            return self::$exponents[$power][0];
        }

        // For power 3 (10^9) and power 5 (10^15), use special logic:
        // - Use "mil millones"/"mil billones" ONLY when this is the ONLY non-zero triplet
        // - Otherwise use just "mil"
        if ($power === 3 || $power === 5) {
            if ($nonZeroTripletCount === 1) {
                // Standalone billion/trillion with no other parts - use "mil millones"
                return self::$exponents[$power][0];
            } else {
                // Part of larger number - use just "mil"
                return 'mil';
            }
        }

        // For millions and billions, use singular if exactly 1, otherwise plural
        if ($number === 1) {
            return self::$exponents[$power][0];
        }

        return self::$exponents[$power][1];
    }
}

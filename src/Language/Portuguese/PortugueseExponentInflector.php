<?php

namespace NumberToWords\Language\Portuguese;

use NumberToWords\Language\PowerAwareExponentInflector;

class PortugueseExponentInflector implements PowerAwareExponentInflector
{
    private static array $exponents = [
        0 => '',
        1 => 'mil',
        2 => 'milhão',
        3 => 'mil milhões',  // Long scale: 10^9
        4 => 'trilhão',
        5 => 'quatrilhão',
        6 => 'quintilhão',
        7 => 'sextilhão',
        8 => 'septilhão',
        9 => 'octilhão',
        10 => 'nonilhão',
    ];

    public function inflectExponent(int $number, int $power): string
    {
        return $this->inflectExponentWithContext($number, $power, $power, 1);
    }

    public function inflectExponentWithContext(
        int $number,
        int $power,
        int $maxPower,
        int $nonZeroTripletCount
    ): string {
        if ($power === 0) {
            return '';
        }

        $exponent = self::$exponents[$power] ?? '';

        // Pluralization: "milhão" → "milhões", "trilhão" → "trilhões"
        // But "mil" and "mil milhões" don't pluralize
        if ($number > 1 && $power !== 1 && $power !== 3) {
            $exponent = str_replace('ão', 'ões', $exponent);
        }

        return $exponent;
    }
}

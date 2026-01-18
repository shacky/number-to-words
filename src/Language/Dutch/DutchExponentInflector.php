<?php

namespace NumberToWords\Language\Dutch;

use NumberToWords\Language\PowerAwareExponentInflector;

class DutchExponentInflector implements PowerAwareExponentInflector
{
    private static array $exponents = [
        0 => '',
        1 => 'duizend',
        2 => 'miljoen',
        3 => 'miljard',
        4 => 'biljoen',
        5 => 'biljard',
        6 => 'triljoen',
        7 => 'triljard',
        8 => 'quadriljoen',
        9 => 'quadriljard',
        10 => 'quintiljoen',
    ];

    public function inflectExponent(int $number, int $power): string
    {
        // Fallback for backward compatibility
        return $this->inflectExponentWithContext($number, $power, $power, 1);
    }

    public function inflectExponentWithContext(int $number, int $power, int $maxPower, int $nonZeroTripletCount): string
    {
        $exponent = self::$exponents[$power] ?? '';

        if ($power === 0) {
            return '';
        }

        // "duizend" (thousand) is concatenated without space before,
        // but needs space after
        if ($power === 1) {
            return $exponent . ' ';
        }

        // Other exponents (million, billion, etc.) have spaces both before and after
        return ' ' . $exponent . ' ';
    }
}

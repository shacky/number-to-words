<?php

namespace NumberToWords\Language\Swahili;

use NumberToWords\Service\NumberToTripletsConverter;

class SwahiliNumberToTripletsConverter extends NumberToTripletsConverter
{
    /**
     * Split number into parts aligned with Swahili exponents: trillioni, bilioni, milioni, laki, elfu, units.
     */
    public function convertToTriplets(int $number): array
    {
        $powers = [12, 9, 6, 5, 3, 0];
        $triplets = [];

        foreach ($powers as $power) {
            $divisor = 10 ** $power;
            $triplets[] = (int) ($number / $divisor);
            $number %= $divisor;
        }

        return $triplets;
    }
}

<?php

namespace NumberToWords\Language\PortugueseBrazilian;

use NumberToWords\Language\PowerAwareTripletTransformer;

class PortugueseBrazilianTripletTransformer implements PowerAwareTripletTransformer
{
    private PortugueseBrazilianDictionary $dictionary;

    public function __construct(PortugueseBrazilianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        if ($number === 0) {
            return null;
        }

        // Special case: exactly 100
        if ($number === 100) {
            return 'cem';
        }

        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;

        $words = [];

        // Hundreds
        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingHundred($hundreds);
        }

        // Teens (11-19)
        if ($tens === 1 && $units > 0) {
            $words[] = $this->dictionary->getCorrespondingTeen($units);
        } else {
            // Tens
            if ($tens > 0) {
                $words[] = $this->dictionary->getCorrespondingTen($tens);
            }

            // Units
            if ($units > 0 && $tens !== 1) {
                $words[] = $this->dictionary->getCorrespondingUnit($units);
            }
        }

        $result = implode(' e ', array_filter($words));

        // Check if we need to prepend " e " for the last non-zero triplet
        // This happens when:
        // 1. Current triplet value < 100 OR is an exact hundred (e.g., 100, 200, 300)
        // 2. All lower powers (powers < current power) are zero
        // 3. Current power > 0 (not the units triplet)
        if ($power > 0 && ($number < 100 || $number % 100 === 0)) {
            // Check if all lower powers are zero
            $allLowerPowersZero = true;
            for ($p = 0; $p < $power; $p++) {
                if (isset($allTriplets[$p]) && $allTriplets[$p] !== 0) {
                    $allLowerPowersZero = false;
                    break;
                }
            }

            if ($allLowerPowersZero) {
                $result = ' e ' . $result;
            }
        }

        return $result;
    }
}

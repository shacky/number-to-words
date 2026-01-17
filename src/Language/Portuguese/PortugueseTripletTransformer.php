<?php

namespace NumberToWords\Language\Portuguese;

use NumberToWords\Language\PowerAwareTripletTransformer;

class PortugueseTripletTransformer implements PowerAwareTripletTransformer
{
    private PortugueseDictionary $dictionary;

    public function __construct(PortugueseDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets = []): ?string
    {
        // Special case: omit "um" before "mil" (1000)
        // and before "mil milhões" (power 3 = 1,000,000,000)
        if ($number === 1 && ($power === 1 || $power === 3)) {
            return null;
        }

        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Check if we should add " e " before this triplet
        // This happens when:
        // 1. There are higher powers (we're not the first triplet)
        // 2. This triplet is < 100 OR is an exact multiple of 100
        // 3. Either: we're at power 0, OR we're the last non-zero triplet (all lower powers are zero)
        $needsConjunction = false;
        
        // Check if there are higher powers
        $hasHigherPowers = false;
        foreach ($allTriplets as $p => $value) {
            if ($p > $power && $value > 0) {
                $hasHigherPowers = true;
                break;
            }
        }

        if ($hasHigherPowers && ($number < 100 || ($number % 100 === 0 && $number > 0))) {
            if ($power === 0) {
                // At power 0, always add " e "
                $needsConjunction = true;
            } elseif (!empty($allTriplets)) {
                // At higher powers, check if all lower powers are zero (we're the last)
                $isLastNonZero = true;
                for ($lowerPower = $power - 1; $lowerPower >= 0; $lowerPower--) {
                    if (isset($allTriplets[$lowerPower]) && $allTriplets[$lowerPower] > 0) {
                        $isLastNonZero = false;
                        break;
                    }
                }
                
                if ($isLastNonZero) {
                    $needsConjunction = true;
                }
            }
        }

        // Hundreds
        if ($hundreds > 0) {
            // Special case: "cem" for exactly 100, "cento" for 101-199
            if ($number === 100) {
                $words[] = 'cem';
            } else {
                $words[] = $this->dictionary->getCorrespondingHundred($hundreds);
            }
        }

        // Teens (10-19)
        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($units);
        } else {
            // Tens (20, 30, ..., 90)
            if ($tens > 0) {
                $words[] = $this->dictionary->getCorrespondingTen($tens);
            }

            // Units (1-9) - but not for teens
            if ($units > 0) {
                $words[] = $this->dictionary->getCorrespondingUnit($units);
            }
        }

        // Join parts with " e " and prepend " e " if needed for conjunction
        $result = implode(' e ', $words);
        if ($needsConjunction) {
            $result = 'e ' . $result;
        }

        return $result;
    }
}

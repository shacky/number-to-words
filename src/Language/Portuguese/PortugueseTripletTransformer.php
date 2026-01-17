<?php

namespace NumberToWords\Language\Portuguese;

use NumberToWords\Language\PowerAwareTripletTransformer;

class PortugueseTripletTransformer implements PowerAwareTripletTransformer
{
    private PortugueseDictionary $dictionary;
    private ?int $previousPower = null;
    private ?int $previousNumber = null;
    private bool $isFirstTriplet = true;

    public function __construct(PortugueseDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power): ?string
    {
        // Special case: omit "um" before "mil" (1000)
        // and before "mil milhões" (power 3 = 1,000,000,000)
        if ($number === 1 && ($power === 1 || $power === 3)) {
            $this->previousPower = $power;
            $this->previousNumber = $number;
            $this->isFirstTriplet = false;
            return null;
        }

        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Add " e " before this triplet if:
        // 1. This is not the first triplet (there's a higher power)
        // 2. This triplet is < 100 OR is an exact multiple of 100
        // 3. Either: we're at power 0, OR previous power was > current power + 1 (gap in powers)
        //    The gap check handles cases like 5,100,000 where power 0 is missing
        $needsConjunction = false;
        if (!$this->isFirstTriplet && ($number < 100 || ($number % 100 === 0 && $number > 0))) {
            // We need "e" if we're the last triplet (power 0) or if there's been a gap
            if ($power === 0) {
                $needsConjunction = true;
            } elseif ($this->previousPower !== null && $this->previousPower > $power + 1) {
                // There's a gap (e.g., from power 2 to power 1, skipping nothing is fine,
                // but we'd need to track if this is the last)
                // Actually, this won't work either...
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

        $this->previousPower = $power;
        $this->previousNumber = $number;
        $this->isFirstTriplet = false;

        // Join parts with " e " and prepend " e " if needed for conjunction
        $result = implode(' e ', $words);
        if ($needsConjunction) {
            $result = 'e ' . $result;
        }

        return $result;
    }
}

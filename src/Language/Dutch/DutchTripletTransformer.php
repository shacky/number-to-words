<?php

namespace NumberToWords\Language\Dutch;

use NumberToWords\Language\PowerAwareTripletTransformer;

class DutchTripletTransformer implements PowerAwareTripletTransformer
{
    private DutchDictionary $dictionary;
    private ?int $previousPower = null;

    public function __construct(DutchDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        // Special case: omit "één" before "duizend" (1000)
        if ($number === 1 && $power === 1) {
            $this->previousPower = $power;
            return null;
        }

        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Special case: add "en " before numbers 1-12 at power 0 after duizend (power 1)
        if ($power === 0 && $this->previousPower === 1 && $number >= 1 && $number <= 12 && $hundreds === 0) {
            $words[] = 'en ';
        }

        // Hundreds
        if ($hundreds > 0) {
            // e.g. "honderd", "tweehonderd", "driehonderd"
            $hundredUnit = $this->dictionary->getCorrespondingUnit($hundreds);
            if ($hundreds === 1) {
                $words[] = 'honderd';
            } else {
                $words[] = $hundredUnit . 'honderd';
            }

            // Special case: add " en " for 101-102, 111-112, etc.
            // But not for 113+, 120+, etc.
            if ($tens === 0 && $units > 0) {
                // 101-109: "honderd en één", "honderd en twee", etc.
                $words[] = ' en ';
            } elseif ($tens === 1 && ($units === 1 || $units === 2)) {
                // 111, 112: "honderd en elf", "honderd en twaalf"
                $words[] = ' en ';
            }
        }

        // Teens (10-19)
        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($units);
        } else {
            // Units come before tens in Dutch (except for teens)
            if ($units > 0 && $tens > 0) {
                // e.g., "éénentwintig" (21), "tweeenzestig" (62)
                $words[] = $this->dictionary->getCorrespondingUnit($units) . 'en'
                    . $this->dictionary->getCorrespondingTen($tens);
            } elseif ($tens > 0) {
                // Just tens: 20, 30, 40, etc.
                $words[] = $this->dictionary->getCorrespondingTen($tens);
            } elseif ($units > 0 && $hundreds === 0) {
                // Just units (1-9) without hundreds
                $words[] = $this->dictionary->getCorrespondingUnit($units);
            } elseif ($units > 0) {
                // Units with hundreds already added with " en "
                $words[] = $this->dictionary->getCorrespondingUnit($units);
            }
        }

        $this->previousPower = $power;
        return implode('', $words);
    }
}

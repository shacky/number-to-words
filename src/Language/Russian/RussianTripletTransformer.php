<?php

namespace NumberToWords\Language\Russian;

use NumberToWords\Language\PowerAwareTripletTransformer;

class RussianTripletTransformer implements PowerAwareTripletTransformer
{
    private RussianDictionary $dictionary;

    public function __construct(RussianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Hundreds
        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingHundred($hundreds);
        }

        // Teens (10-19)
        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($units);
        } elseif ($tens > 1) {
            // Tens (20, 30, ..., 90)
            $words[] = $this->dictionary->getCorrespondingTen($tens);
        }

        // Units (but not for teens)
        if ($units > 0 && $tens !== 1) {
            // Use female forms for thousands (power == 1)
            if ($power === 1) {
                $words[] = $this->dictionary->getCorrespondingUnitFemale($units);
            } else {
                $words[] = $this->dictionary->getCorrespondingUnit($units);
            }
        }

        return implode(' ', $words);
    }
}

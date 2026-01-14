<?php

namespace NumberToWords\Language\Swedish;

use NumberToWords\Language\TripletTransformer;

class SwedishTripletTransformer implements TripletTransformer
{
    private SwedishDictionary $dictionary;

    public function __construct(SwedishDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number): string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Hundreds: "en hundra", "två hundra", etc.
        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingUnit($hundreds);
            $words[] = 'hundra';
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
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        }

        return implode(' ', $words);
    }
}

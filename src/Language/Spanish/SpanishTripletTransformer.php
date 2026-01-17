<?php

namespace NumberToWords\Language\Spanish;

use NumberToWords\Language\PowerAwareTripletTransformer;

class SpanishTripletTransformer implements PowerAwareTripletTransformer
{
    private SpanishDictionary $dictionary;

    public function __construct(SpanishDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets = []): ?string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        
        // Special case: for exactly 1 at certain powers, return null
        // Spanish: 1000 = "mil", not "un mil" or "uno mil"
        if ($number === 1 && ($power === 1 || $power === 3 || $power === 5)) {
            return null;
        }
        
        $words = [];

        // Hundreds
        if ($hundreds > 0) {
            if ($hundreds === 1 && $tens === 0 && $units === 0) {
                // Exactly 100 is "cien"
                $words[] = 'cien';
            } else {
                // 101-199 use "ciento"
                $words[] = $this->dictionary->getCorrespondingHundred($hundreds);
            }
        }

        // Teens (10-19)
        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($units);
        } elseif ($tens === 2 && $units > 0) {
            // 21-29 use "veinti..." compound words
            if ($units === 1 && $power > 0) {
                $words[] = 'veintiún';
            } else {
                $words[] = 'veinti' . $this->dictionary->getCorrespondingUnit($units);
            }
        } elseif ($tens > 1) {
            // Tens (20, 30-90)
            $words[] = $this->dictionary->getCorrespondingTen($tens);
        }

        // Units (but not for teens or 21-29)
        if ($units > 0 && $tens !== 1 && !($tens === 2 && $units > 0)) {
            // Add "y" conjunction for 31-99
            if ($tens > 2) {
                $words[] = 'y';
            }
            
            // Use "un" instead of "uno" when there's an exponent (but not for certain powers)
            if ($units === 1 && $power > 0 && $power !== 1 && $power !== 3 && $power !== 5) {
                $words[] = 'un';
            } else {
                $words[] = $this->dictionary->getCorrespondingUnit($units);
            }
        }

        return implode(' ', $words);
    }
}

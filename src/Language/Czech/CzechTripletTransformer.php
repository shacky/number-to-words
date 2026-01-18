<?php

namespace NumberToWords\Language\Czech;

use NumberToWords\Language\PowerAwareTripletTransformer;

class CzechTripletTransformer implements PowerAwareTripletTransformer
{
    private CzechDictionary $dictionary;

    public function __construct(CzechDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];
        
        // Don't output "jedna" for exactly 1 when there's an exponent (thousand, million, etc.)
        if ($number === 1 && $power > 0) {
            return null;
        }
        
        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingHundred($hundreds);
        }

        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($units);
        } elseif ($tens > 1) {
            $words[] = $this->dictionary->getCorrespondingTen($tens);
        }

        if ($units > 0 && $tens !== 1) {
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        }

        return implode(' ', $words);
    }
}

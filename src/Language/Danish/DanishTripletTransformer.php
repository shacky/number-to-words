<?php

namespace NumberToWords\Language\Danish;

use NumberToWords\Language\TripletTransformer;

class DanishTripletTransformer implements TripletTransformer
{
    private DanishDictionary $dictionary;

    public function __construct(DanishDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number): string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Hundreds
        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingUnit($hundreds);
            $words[] = 'hundrede';
        }

        // Teens (10-19)
        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($units);
        } elseif ($tens > 1) {
            // Tens
            $words[] = $this->dictionary->getCorrespondingTen($tens);
        }

        // Units (but not for teens)
        if ($units > 0 && $tens !== 1) {
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        }

        return implode(' ', $words);
    }
}

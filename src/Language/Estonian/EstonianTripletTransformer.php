<?php

namespace NumberToWords\Language\Estonian;

use NumberToWords\Language\TripletTransformer;

class EstonianTripletTransformer implements TripletTransformer
{
    private EstonianDictionary $dictionary;

    public function __construct(EstonianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number): string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Hundreds: "ükssada", "kakssada", etc.
        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingUnit($hundreds) . 'sada';
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

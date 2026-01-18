<?php

namespace NumberToWords\Language\Lithuanian;

use NumberToWords\Language\PowerAwareTripletTransformer;

class LithuanianTripletTransformer implements PowerAwareTripletTransformer
{
    private LithuanianDictionary $dictionary;

    public function __construct(LithuanianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Don't output "vienas" for exactly 1 when there's an exponent (thousand, million, etc.)
        if ($number === 1 && $power > 0) {
            return null;
        }

        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingHundred($hundreds);
        }

        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTen($units);
        } elseif ($tens > 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($tens);
        }

        if ($units > 0 && $tens !== 1) {
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        }

        return implode(' ', $words);
    }
}

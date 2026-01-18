<?php

namespace NumberToWords\Language\Malay;

use NumberToWords\Language\PowerAwareTripletTransformer;

class MalayTripletTransformer implements PowerAwareTripletTransformer
{
    private MalayDictionary $dictionary;

    public function __construct(MalayDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        if ($number === 0) {
            return null;
        }

        // Special case: 1000 handled via exponent inflector (returns "seribu")
        if ($power === 1 && $number === 1) {
            return null;
        }

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
            $words[] = $this->dictionary->getCorrespondingTen($tens);
        }

        // Units (not for teens)
        if ($units > 0 && $tens !== 1) {
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        }

        return implode(' ', array_filter($words));
    }
}

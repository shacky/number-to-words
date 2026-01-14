<?php

namespace NumberToWords\Language\Turkish;

use NumberToWords\Language\PowerAwareTripletTransformer;

class TurkishTripletTransformer implements PowerAwareTripletTransformer
{
    private TurkishDictionary $dictionary;

    public function __construct(TurkishDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power): ?string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Hundreds: "bir" is omitted for 100 (just "yüz"), but included for 200-900
        if ($hundreds > 0) {
            if ($hundreds > 1) {
                $words[] = $this->dictionary->getCorrespondingUnit($hundreds);
            }
            $words[] = 'yüz';
        }

        // Tens
        if ($tens > 0) {
            $words[] = $this->dictionary->getCorrespondingTen($tens);
        }

        // Units: "bir" is omitted for 1000 (just "bin"), but included otherwise
        if ($units > 0) {
            // Only omit "bir" if this is exactly 1 for thousands (power == 1)
            if ($units === 1 && $power === 1 && $hundreds === 0 && $tens === 0) {
                return null;
            }
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        }

        return implode(' ', $words);
    }
}

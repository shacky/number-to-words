<?php

namespace NumberToWords\Language\Turkmen;

use NumberToWords\Language\TripletTransformer;

class TurkmenTripletTransformer implements TripletTransformer
{
    private TurkmenDictionary $dictionary;

    public function __construct(TurkmenDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number): string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Hundreds: "bir ýüz", "iki ýüz", etc. (always includes the multiplier)
        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingUnit($hundreds);
            $words[] = 'ýüz';
        }

        // Tens
        if ($tens > 0) {
            $words[] = $this->dictionary->getCorrespondingTen($tens);
        }

        // Units
        if ($units > 0) {
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        }

        return implode(' ', $words);
    }
}

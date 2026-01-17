<?php

namespace NumberToWords\Language\Italian;

use NumberToWords\Language\PowerAwareTripletTransformer;

class ItalianTripletTransformer implements PowerAwareTripletTransformer
{
    private ItalianDictionary $dictionary;

    public function __construct(ItalianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets = []): ?string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;

        $words = [];

        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingHundred($hundreds);
        }

        if ($tens === 0 && $units === 0) {
            if (empty($words)) {
                return null;
            }
            return implode('', $words);
        }

        if ($tens === 1) {
            if ($units === 0) {
                $words[] = $this->dictionary->getCorrespondingTen(1); // "dieci"
            } else {
                $words[] = $this->dictionary->getCorrespondingTeen($number % 100);
            }
            return implode('', $words);
        }

        if ($tens >= 2) {
            $tenWord = $this->dictionary->getCorrespondingTen($tens);
            
            // Italian: drop final vowel for units 1 and 8
            if ($units === 1 || $units === 8) {
                $tenWord = rtrim($tenWord, 'aio'); // removes final 'a' or 'i' or 'o'
                if ($units === 1) {
                    $words[] = $tenWord . 'uno';
                } else {
                    $words[] = $tenWord . 'otto';
                }
            } elseif ($units > 0) {
                $words[] = $tenWord . $this->dictionary->getCorrespondingUnit($units);
            } else {
                $words[] = $tenWord;
            }
            
            return implode('', $words);
        }

        if ($units > 0) {
            // For thousands (power == 1), omit "uno" if number is exactly 1
            if ($power === 1 && $units === 1 && $tens === 0 && $hundreds === 0) {
                return null;
            }
            
            // For power > 0 and units = 1, use "un" instead of "uno"
            if ($power > 0 && $units === 1) {
                $words[] = 'un';
            } else {
                $words[] = $this->dictionary->getCorrespondingUnit($units);
            }
        }

        if (empty($words)) {
            return null;
        }

        return implode('', $words);
    }
}

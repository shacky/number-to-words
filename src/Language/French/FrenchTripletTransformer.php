<?php

namespace NumberToWords\Language\French;

use NumberToWords\Language\PowerAwareTripletTransformer;

class FrenchTripletTransformer implements PowerAwareTripletTransformer
{
    private FrenchDictionary $dictionary;

    public function __construct(FrenchDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        // Special case: omit "un" before "mille" (1000)
        if ($number === 1 && $power === 1) {
            return null;
        }

        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Hundreds
        if ($hundreds > 0) {
            if ($hundreds === 1) {
                $words[] = 'cent';
            } else {
                $words[] = $this->dictionary->getCorrespondingUnit($hundreds) . ' cent';
            }

            // Add 's' to hundreds when it's the final part (e.g., "trois cents")
            // But not when followed by other digits (e.g., "trois cent un")
            if ($hundreds > 1 && $tens === 0 && $units === 0) {
                $words[count($words) - 1] .= 's';
            }
        }

        // Handle 70-79: soixante-dix, soixante et onze, etc.
        if ($tens === 7) {
            if ($units === 0) {
                $words[] = 'soixante-dix';
            } elseif ($units === 1) {
                $words[] = 'soixante et onze';
            } else {
                $words[] = 'soixante-' . $this->dictionary->getCorrespondingTeen($units);
            }
            return implode(' ', $words);
        }

        // Handle 80-99: quatre-vingts, quatre-vingt-un, quatre-vingt-dix, etc.
        if ($tens === 8) {
            if ($units === 0) {
                $words[] = 'quatre-vingts';
            } else {
                $words[] = 'quatre-vingt-' . $this->dictionary->getCorrespondingUnit($units);
            }
            return implode(' ', $words);
        }

        if ($tens === 9) {
            if ($units === 0) {
                $words[] = 'quatre-vingt-dix';
            } elseif ($units === 1) {
                $words[] = 'quatre-vingt-onze';
            } else {
                $words[] = 'quatre-vingt-' . $this->dictionary->getCorrespondingTeen($units);
            }
            return implode(' ', $words);
        }

        // Handle teens (10-19)
        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($units);
            return implode(' ', $words);
        }

        // Handle regular tens (20-69)
        if ($tens > 1 && $tens < 7) {
            if ($units === 0) {
                $words[] = $this->dictionary->getCorrespondingTen($tens);
            } elseif ($units === 1) {
                // Use "et" for 21, 31, 41, 51, 61
                $words[] = $this->dictionary->getCorrespondingTen($tens) . ' et un';
            } else {
                $words[] = $this->dictionary->getCorrespondingTen($tens) . '-' . $this->dictionary->getCorrespondingUnit($units);
            }
            return implode(' ', $words);
        }

        // Handle units only (1-9)
        if ($units > 0) {
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        }

        return implode(' ', $words);
    }
}

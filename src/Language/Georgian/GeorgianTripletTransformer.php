<?php

namespace NumberToWords\Language\Georgian;

use NumberToWords\Language\PowerAwareTripletTransformer;

class GeorgianTripletTransformer implements PowerAwareTripletTransformer
{
    private GeorgianDictionary $dictionary;

    public function __construct(GeorgianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        if ($number === 0) {
            return null;
        }

        // For thousands and higher, if number is exactly 1, omit it
        if ($number === 1 && $power > 0) {
            return null;
        }

        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Handle hundreds (100-999)
        if ($hundreds > 0) {
            $hundredPart = '';
            if ($hundreds > 1) {
                $hundredPart = $this->dictionary->getCorrespondingUnit($hundreds);
            }
            $hundredPart .= $this->dictionary->getCorrespondingHundred($hundreds);
            $words[] = $hundredPart;
        }

        // Handle 0-99
        $remainder = $number % 100;
        if ($remainder > 0) {
            if ($remainder <= 9) {
                // 1-9: direct units
                $words[] = $this->dictionary->getCorrespondingUnit($remainder);
            } elseif ($remainder >= 10 && $remainder <= 19) {
                // 10-19: teens
                $words[] = $this->dictionary->getCorrespondingTeen($remainder);
            } else {
                // 20-99: vigesimal system
                $twenties = ((int) ($remainder / 20)) * 20;
                $remainderUnits = $remainder % 20;

                if ($remainderUnits === 0) {
                    // Exactly 20, 40, 60, 80
                    $words[] = $this->dictionary->getCorrespondingTwenty($twenties);
                } else {
                    // 21-39, 41-59, 61-79, 81-99
                    $twentyPart = $this->dictionary->getCorrespondingTwenty($twenties);
                    $conjunction = $this->dictionary->getConjunction();
                    
                    if ($remainderUnits <= 9) {
                        $unitPart = $this->dictionary->getCorrespondingUnit($remainderUnits);
                    } else {
                        // 10-19 within the twenty group (e.g., 30 = 20+10)
                        $unitPart = $this->dictionary->getCorrespondingTeen($remainderUnits);
                    }
                    
                    $words[] = $twentyPart . $conjunction . $unitPart;
                }
            }
        }

        $result = implode(' ', $words);

        // Add suffix "ი" except for numbers ending in 8 or 9
        if (!in_array($number % 20, [8, 9])) {
            $result .= $this->dictionary->getSuffix();
        }

        return $result;
    }
}

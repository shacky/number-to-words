<?php

namespace NumberToWords\Language\PortugueseBrazilian;

use NumberToWords\Language\PowerAwareTripletTransformer;

class PortugueseBrazilianTripletTransformer implements PowerAwareTripletTransformer
{
    private PortugueseBrazilianDictionary $dictionary;

    public function __construct(PortugueseBrazilianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        if ($number === 0) {
            return null;
        }

        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Determine if we need a leading conjunction "e" before this triplet
        $needsConjunction = false;

        // Are there higher powers with non-zero triplets?
        $hasHigherPowers = false;
        foreach ($allTriplets as $p => $value) {
            if ($p > $power && $value > 0) {
                $hasHigherPowers = true;
                break;
            }
        }

        if ($hasHigherPowers && ($number < 100 || ($number % 100 === 0 && $number > 0))) {
            if ($power === 0) {
                $needsConjunction = true;
            } else {
                $isLastNonZero = true;
                for ($lower = $power - 1; $lower >= 0; $lower--) {
                    if (isset($allTriplets[$lower]) && $allTriplets[$lower] > 0) {
                        $isLastNonZero = false;
                        break;
                    }
                }

                if ($isLastNonZero) {
                    $needsConjunction = true;
                }
            }
        }

        // Hundreds
        if ($hundreds > 0) {
            // "cem" only for exactly 100, otherwise "cento"
            if ($number === 100) {
                $words[] = 'cem';
            } else {
                $words[] = $this->dictionary->getCorrespondingHundred($hundreds);
            }
        }

        // Teens (10-19)
        if ($tens === 1) {
            $words[] = $this->dictionary->getCorrespondingTeen($units);
        } else {
            // Tens
            if ($tens > 0) {
                $words[] = $this->dictionary->getCorrespondingTen($tens);
            }

            // Units
            if ($units > 0) {
                $words[] = $this->dictionary->getCorrespondingUnit($units);
            }
        }

        $result = implode(' e ', array_filter($words));

        if ($needsConjunction) {
            $result = 'e ' . $result;
        }

        return $result;
    }
}

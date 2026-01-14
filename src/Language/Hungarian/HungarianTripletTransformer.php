<?php

namespace NumberToWords\Language\Hungarian;

use NumberToWords\Language\TripletTransformer;

class HungarianTripletTransformer implements TripletTransformer
{
    private HungarianDictionary $dictionary;

    public function __construct(HungarianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number): string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;
        $hundreds = (int) ($number / 100) % 10;
        $words = [];

        // Hundreds: "egyszáz", "kettőszáz", "háromszáz", etc.
        if ($hundreds > 0) {
            $words[] = $this->dictionary->getCorrespondingUnit($hundreds) . 'száz';
        }

        // Tens and units
        if ($tens === 1) {
            // Teens: 10-19
            if ($units === 0) {
                $words[] = 'tíz';
            } else {
                $words[] = 'tizen' . $this->dictionary->getCorrespondingUnit($units);
            }
        } elseif ($tens === 2) {
            // 20s: special case
            if ($units === 0) {
                $words[] = 'húsz';
            } else {
                $words[] = 'huszon' . $this->dictionary->getCorrespondingUnit($units);
            }
        } elseif ($tens > 0) {
            // 30-90
            $tenWord = $this->getTenWord($tens);
            if ($units > 0) {
                $words[] = $tenWord . $this->dictionary->getCorrespondingUnit($units);
            } else {
                $words[] = $tenWord;
            }
        } elseif ($units > 0) {
            // Just units (no tens)
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        }

        return implode('', $words);
    }

    private function getTenWord(int $ten): string
    {
        return match ($ten) {
            3 => 'harminc',
            4 => 'negyven',
            5 => 'ötven',
            6 => 'hatvan',
            7 => 'hetven',
            8 => 'nyolcvan',
            9 => 'kilencven',
            default => '',
        };
    }
}

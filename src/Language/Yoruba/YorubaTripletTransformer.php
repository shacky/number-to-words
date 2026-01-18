<?php

namespace NumberToWords\Language\Yoruba;

use NumberToWords\Language\PowerAwareTripletTransformer;

class YorubaTripletTransformer implements PowerAwareTripletTransformer
{
    private const EXPONENTS = [
        0 => '',
        1 => 'ẹgbẹrun',
        2 => 'miliọnu',
        3 => 'biliọnu',
        4 => 'miliọnu miliọnu',
        5 => 'biliọnu miliọnu',
        6 => 'biliọnu biliọnu',
    ];

    private YorubaDictionary $dictionary;

    public function __construct(YorubaDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function transformToWords(int $number, int $power, array $allTriplets): ?string
    {
        if ($number === 0) {
            return null;
        }

        $phrase = $this->transformUnderThousand($number);
        $exponent = self::EXPONENTS[$power] ?? '';

        if ($exponent !== '') {
            return trim($exponent . ' ' . $phrase);
        }

        return $phrase;
    }

    private function transformUnderThousand(int $number): string
    {
        $hundreds = (int) ($number / 100);
        $remainder = $number % 100;

        $parts = [];

        if ($hundreds > 0) {
            $parts[] = $this->dictionary->getCorrespondingHundred($hundreds);
        }

        if ($remainder > 0) {
            $parts[] = $this->formatBelowHundred($remainder, $hundreds > 0);
        }

        return implode(' ', array_filter($parts));
    }

    private function formatBelowHundred(int $number, bool $prependConjunction): string
    {
        $units = $number % 10;
        $tens = (int) ($number / 10);

        $words = [];

        if ($prependConjunction) {
            $words[] = 'ati';
        }

        if ($number < 10) {
            $words[] = $this->dictionary->getCorrespondingUnit($units);
        } elseif ($number < 20) {
            $words[] = $this->dictionary->getCorrespondingTeen($number);
        } else {
            $words[] = $this->dictionary->getCorrespondingTen($tens);

            if ($units > 0) {
                $words[] = 'ati';
                $words[] = $this->dictionary->getCorrespondingUnit($units);
            }
        }

        return implode(' ', array_filter($words));
    }
}

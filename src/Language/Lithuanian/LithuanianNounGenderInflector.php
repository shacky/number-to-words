<?php

namespace NumberToWords\Language\Lithuanian;

class LithuanianNounGenderInflector
{
    public function inflectNounByNumber(
        int $number,
        string $singular,
        string $genitivePlural,
        string $nominativePlural
    ): string {
        $units = $number % 10;
        $tens = ((int) ($number / 10)) % 10;

        // For numbers ending in 10-19, use genitive plural
        if ($tens === 1) {
            return $genitivePlural;
        }

        // For numbers ending in 2-9 (but not 10-19), use nominative plural
        if ($units >= 2 && $units <= 9) {
            return $nominativePlural;
        }

        // For numbers ending in 0 or 1, use singular
        return $singular;
    }
}

<?php

namespace NumberToWords\Language\Ukrainian;

class UkrainianNounGenderInflector
{
    /**
     * Inflect a noun based on number using Slavic inflection rules
     *
     * @param int $number The number to base inflection on
     * @param string $singular Singular form (for 1, 21, 31, ...)
     * @param string $genitiveSingular Genitive singular form (for 2-4, 22-24, 32-34, ...)
     * @param string $genitivePlural Genitive plural form (for 0, 5-20, 25-30, ...)
     * @return string The correctly inflected form
     */
    public function inflectNounByNumber(int $number, string $singular, string $genitiveSingular, string $genitivePlural): string
    {
        $number = abs($number);
        $units = $number % 10;
        $tens = (int) ($number / 10) % 10;

        // Numbers ending in 1 (but not 11) use singular form
        if ($units === 1 && $tens !== 1) {
            return $singular;
        }

        // Numbers ending in 2-4 (but not 12-14) use genitive singular form
        if ($units >= 2 && $units <= 4 && $tens !== 1) {
            return $genitiveSingular;
        }

        // All other numbers (0, 5-20, 25-30, etc.) use genitive plural form
        return $genitivePlural;
    }
}

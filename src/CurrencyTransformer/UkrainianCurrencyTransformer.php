<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\Ukrainian\UkrainianDictionary;
use NumberToWords\Language\Ukrainian\UkrainianExponentInflector;
use NumberToWords\Language\Ukrainian\UkrainianNounGenderInflector;
use NumberToWords\Language\Ukrainian\UkrainianTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class UkrainianCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new UkrainianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new UkrainianTripletTransformer($dictionary);
        $exponentInflector = new UkrainianExponentInflector();
        $nounGenderInflector = new UkrainianNounGenderInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        [$decimal, $fraction] = $this->splitAmount($amount, $currency);

        if ($fraction === 0) {
            $fraction = null;
        }

        $currency = strtoupper($currency);

        if (!array_key_exists($currency, UkrainianDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currency, get_class($this))
            );
        }

        $currencyNames = UkrainianDictionary::$currencyNames[$currency];

        $words = [];

        // Main currency amount - only output if non-zero or if there's no fraction
        if ($decimal !== 0 || $fraction === null) {
            $mainGender = $currencyNames[0][0];
            $words[] = $this->convertNumberWithGender($decimal, $mainGender, $dictionary, $numberTransformer);
            $words[] = $nounGenderInflector->inflectNounByNumber(
                $decimal,
                $currencyNames[0][1],
                $currencyNames[0][2],
                $currencyNames[0][3]
            );
        }

        if (null !== $fraction) {
            // Subunit amount
            $subGender = $currencyNames[1][0];
            $words[] = $this->convertNumberWithGender($fraction, $subGender, $dictionary, $numberTransformer);
            $words[] = $nounGenderInflector->inflectNounByNumber(
                $fraction,
                $currencyNames[1][1],
                $currencyNames[1][2],
                $currencyNames[1][3]
            );
        }

        return implode(' ', $words);
    }

    /**
     * Convert a number to words using the appropriate gender
     *
     * @param int $number Number to convert
     * @param int $gender Gender (0=neuter, 1=masculine, 2=feminine)
     * @param UkrainianDictionary $dictionary
     * @param NumberTransformer $numberTransformer
     * @return string
     */
    private function convertNumberWithGender(
        int $number,
        int $gender,
        UkrainianDictionary $dictionary,
        NumberTransformer $numberTransformer
    ): string {
        // For feminine gender, override numbers ending in 1 or 2 (but not 11-19)
        if ($gender === 2) {
            $units = abs($number) % 10;
            $tens = (int) (abs($number) / 10) % 10;

            if ($units === 1 && $tens !== 1) {
                // Numbers ending in 1 (but not 11): replace "один" with "одна"
                $words = $numberTransformer->toWords($number);
                return preg_replace('/(?<![а-яА-ЯёЁіІїЇєЄ])один(?![а-яА-ЯёЁіІїЇєЄ])/u', 'одна', $words);
            }
            if ($units === 2 && $tens !== 1) {
                // Numbers ending in 2 (but not 12): replace "два" with "дві"
                $words = $numberTransformer->toWords($number);
                return preg_replace('/(?<![а-яА-ЯёЁіІїЇєЄ])два(?![а-яА-ЯёЁіІїЇєЄ])/u', 'дві', $words);
            }
        }

        return $numberTransformer->toWords($number);
    }
}

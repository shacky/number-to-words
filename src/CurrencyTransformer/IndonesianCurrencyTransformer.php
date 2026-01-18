<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\Indonesian\IndonesianDictionary;
use NumberToWords\Language\Indonesian\IndonesianExponentInflector;
use NumberToWords\Language\Indonesian\IndonesianTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class IndonesianCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new IndonesianDictionary();
        $currencyCode = strtoupper($currency);

        if (!array_key_exists($currencyCode, IndonesianDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currencyCode, get_class($this))
            );
        }

        [$decimal, $fraction] = $this->splitAmount($amount, $currencyCode);

        if ($fraction === 0) {
            $fraction = null;
        }

        $currencyNames = IndonesianDictionary::$currencyNames[$currencyCode];

        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new IndonesianTripletTransformer($dictionary);
        $exponentInflector = new IndonesianExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        $words = [];
        $words[] = trim($numberTransformer->toWords($decimal));
        $words[] = $currencyNames[0][0];

        if (null !== $fraction) {
            $words[] = trim($numberTransformer->toWords($fraction));
            $words[] = $currencyNames[1][0];
        }

        return implode(' ', $words);
    }
}

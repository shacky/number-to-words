<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\Georgian\GeorgianDictionary;
use NumberToWords\Language\Georgian\GeorgianExponentInflector;
use NumberToWords\Language\Georgian\GeorgianTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class GeorgianCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new GeorgianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new GeorgianTripletTransformer($dictionary);
        $exponentInflector = new GeorgianExponentInflector($dictionary);

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

        if (!array_key_exists($currency, GeorgianDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currency, get_class($this))
            );
        }

        $currencyNames = GeorgianDictionary::$currencyNames[$currency];
        $parts = [];

        if ($decimal !== 0) {
            $decimalWords = trim($numberTransformer->toWords($decimal));
            $majorLevel = ($decimal === 1) ? 0 : 1;
            $majorName = $currencyNames[0][$majorLevel] ?? $currencyNames[0][0];

            $parts[] = $decimalWords . ' ' . $majorName;
        }

        if (null !== $fraction) {
            $fractionWords = trim($numberTransformer->toWords($fraction));
            $fractionLevel = ($fraction === 1) ? 0 : 1;
            $minorName = $currencyNames[1][$fractionLevel] ?? $currencyNames[1][0];

            $fractionPart = $fractionWords . ' ' . $minorName;

            if ($decimal !== 0) {
                $parts[] = $dictionary->getConjunction() . ' ' . $fractionPart;
            } else {
                $parts[] = $fractionPart;
            }
        }

        return trim(implode(' ', $parts));
    }
}

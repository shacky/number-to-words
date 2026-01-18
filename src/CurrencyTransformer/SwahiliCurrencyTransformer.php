<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\Swahili\SwahiliDictionary;
use NumberToWords\Language\Swahili\SwahiliNumberToTripletsConverter;
use NumberToWords\Language\Swahili\SwahiliTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class SwahiliCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new SwahiliDictionary();
        $numberToTripletsConverter = new SwahiliNumberToTripletsConverter();
        $tripletTransformer = new SwahiliTripletTransformer($dictionary);

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(', ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->build();

        [$decimal, $fraction] = $this->splitAmount($amount, $currency);

        if ($fraction === 0) {
            $fraction = null;
        }

        $currency = strtoupper($currency);

        if (!array_key_exists($currency, SwahiliDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currency, get_class($this))
            );
        }

        $currencyNames = SwahiliDictionary::$currencyNames[$currency];

        $result = trim($numberTransformer->toWords($decimal));

        $majorLevel = ($decimal === 1) ? 0 : 1;
        $majorName = $currencyNames[0][$majorLevel] ?? $currencyNames[0][0];
        $result = $majorName . ' ' . $result;

        if (null !== $fraction) {
            $fractionWords = trim($numberTransformer->toWords($fraction));

            $fractionLevel = ($fraction === 1) ? 0 : 1;
            $minorName = $currencyNames[1][$fractionLevel] ?? $currencyNames[1][0];

            $result .= ' na ' . $minorName;

            if ($fractionWords !== '') {
                $result .= ' ' . $fractionWords;
            }
        }

        return trim($result);
    }
}

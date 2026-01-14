<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\Spanish\SpanishDictionary;
use NumberToWords\Language\Spanish\SpanishExponentInflector;
use NumberToWords\Language\Spanish\SpanishTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class SpanishCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new SpanishDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new SpanishTripletTransformer($dictionary);
        $exponentInflector = new SpanishExponentInflector();

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

        if (!array_key_exists($currency, SpanishDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currency, get_class($this))
            );
        }

        $currencyNames = SpanishDictionary::$currencyNames[$currency];

        $return = trim($numberTransformer->toWords($decimal));
        
        // Use singular (level 0) only when number is exactly 1, otherwise use plural (level 1)
        $level = ($decimal === 1) ? 0 : 1;

        // In Spanish, "uno" becomes "un" before a masculine noun (currency names)
        // This applies when the number ends with "uno" (1, 21, 31, 101, etc.)
        if ($decimal % 10 === 1 && $decimal % 100 !== 11) {
            $return = preg_replace('/\buno$/', 'un', $return);
        }

        if (isset($currencyNames[0][$level])) {
            $return .= ' ' . $currencyNames[0][$level];
        } else {
            $return .= ' ' . $currencyNames[0][0];
        }

        if (null !== $fraction) {
            $return .= ' con '; // Add "con" (with) before fraction
            
            $fractionWords = trim($numberTransformer->toWords($fraction));

            // Use singular (level 0) only when number is exactly 1, otherwise use plural (level 1)
            $level = ($fraction === 1) ? 0 : 1;

            // In Spanish, "uno" becomes "un" before a masculine noun
            if ($fraction % 10 === 1 && $fraction % 100 !== 11) {
                $fractionWords = preg_replace('/\buno$/', 'un', $fractionWords);
            }

            $return .= $fractionWords;

            if (isset($currencyNames[1][$level])) {
                $return .= ' ' . $currencyNames[1][$level];
            } else {
                $return .= ' ' . $currencyNames[1][0];
            }
        }

        return $return;
    }
}

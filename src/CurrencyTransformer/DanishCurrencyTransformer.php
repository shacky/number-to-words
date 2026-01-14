<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\Danish\DanishDictionary;
use NumberToWords\Language\Danish\DanishExponentGetter;
use NumberToWords\Language\Danish\DanishTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class DanishCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new DanishDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new DanishTripletTransformer($dictionary);
        $exponentGetter = new DanishExponentGetter();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
            ->useRegularExponents($exponentGetter)
            ->build();

        [$decimal, $fraction] = $this->splitAmount($amount, $currency);

        if ($fraction === 0) {
            $fraction = null;
        }

        $currency = strtoupper($currency);

        if (!array_key_exists($currency, DanishDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currency, get_class($this))
            );
        }

        $currencyNames = DanishDictionary::$currencyNames[$currency];

        $return = trim($numberTransformer->toWords($decimal));
        $level = ($decimal === 1) ? 0 : 1;

        if ($level > 0) {
            if (count($currencyNames[0]) > 1) {
                $return .= ' ' . $currencyNames[0][$level];
            } else {
                $return .= ' ' . $currencyNames[0][0];
            }
        } else {
            $return .= ' ' . $currencyNames[0][0];
        }

        if (null !== $fraction) {
            $return .= ' ' . trim($numberTransformer->toWords($fraction));

            $level = $fraction === 1 ? 0 : 1;

            if ($level > 0) {
                if (count($currencyNames[1]) > 1) {
                    $return .= ' ' . $currencyNames[1][$level];
                } else {
                    $return .= ' ' . $currencyNames[1][0];
                }
            } else {
                $return .= ' ' . $currencyNames[1][0];
            }
        }

        return $return;
    }
}

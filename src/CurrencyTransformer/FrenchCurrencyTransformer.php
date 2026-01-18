<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\French\FrenchDictionary;
use NumberToWords\Language\French\FrenchExponentInflector;
use NumberToWords\Language\French\FrenchTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class FrenchCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new FrenchDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new FrenchTripletTransformer($dictionary);
        $exponentInflector = new FrenchExponentInflector();

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

        if (!array_key_exists($currency, FrenchDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currency, get_class($this))
            );
        }

        $currencyNames = FrenchDictionary::$currencyNames[$currency];

        $return = '';

        if ($decimal !== 0 || null === $fraction) {
            $decimalWords = trim($numberTransformer->toWords($decimal));
            $level = ($decimal === 1) ? 0 : 1;
            $majorName = $currencyNames[0][$level] ?? $currencyNames[0][0];

            $return = $decimalWords . ' ' . $majorName;
        }

        if (null !== $fraction) {
            $fractionWords = trim($numberTransformer->toWords($fraction));
            $fractionLevel = ($fraction === 1) ? 0 : 1;
            $minorName = $currencyNames[1][$fractionLevel] ?? $currencyNames[1][0];

            $fractionPart = $fractionWords . ' ' . $minorName;

            if ($return !== '') {
                $return .= ' et ' . $fractionPart;
            } else {
                $return = $fractionPart;
            }
        }

        return trim($return);
    }
}

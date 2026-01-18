<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\Romanian\Dictionary;
use NumberToWords\Language\Romanian\RomanianExponentInflector;
use NumberToWords\Language\Romanian\RomanianTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class RomanianCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new Dictionary();
        $currencyCode = strtoupper($currency);

        if (!array_key_exists($currencyCode, Dictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currencyCode, get_class($this))
            );
        }

        [$decimal, $fraction] = $this->splitAmount($amount, $currencyCode);

        if ($fraction === 0) {
            $fraction = null;
        }

        $currencyNouns = Dictionary::$currencyNames[$currencyCode];

        $numberToTripletsConverter = new NumberToTripletsConverter();
        $exponentInflector = new RomanianExponentInflector($dictionary);

        $decimalTripletTransformer = (new RomanianTripletTransformer($dictionary))
            ->setGrammaticalGender($currencyNouns[0][2])
            ->setUseArticleForOne(true);

        $numberTransformerDecimal = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy($dictionary->getWordSeparator())
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $decimalTripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        $words = [];
        $words[] = $numberTransformerDecimal->toWords($decimal);
        $words[] = $dictionary->getNounDeclensionForNumber($decimal, $currencyNouns[0], $decimal !== 1);

        if (null !== $fraction) {
            $fractionTripletTransformer = (new RomanianTripletTransformer($dictionary))
                ->setGrammaticalGender($currencyNouns[1][2])
                ->setUseArticleForOne(true);

            $numberTransformerFraction = (new NumberTransformerBuilder())
                ->withDictionary($dictionary)
                ->withWordsSeparatedBy($dictionary->getWordSeparator())
                ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $fractionTripletTransformer)
                ->inflectExponentByNumbers($exponentInflector)
                ->build();

            $words[] = $dictionary->getAnd();
            $words[] = $numberTransformerFraction->toWords($fraction);
            $words[] = $dictionary->getNounDeclensionForNumber($fraction, $currencyNouns[1], $fraction !== 1);
        }

        return implode($dictionary->getWordSeparator(), $words);
    }
}

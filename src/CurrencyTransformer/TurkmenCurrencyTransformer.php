<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\Turkmen\TurkmenDictionary;
use NumberToWords\Language\Turkmen\TurkmenExponentGetter;
use NumberToWords\Language\Turkmen\TurkmenTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class TurkmenCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new TurkmenDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new TurkmenTripletTransformer($dictionary);
        $exponentGetter = new TurkmenExponentGetter();

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

        if (!array_key_exists($currency, TurkmenDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currency, get_class($this))
            );
        }

        $currencyNames = TurkmenDictionary::$currencyNames[$currency];

        $return = trim($numberTransformer->toWords($decimal)) . ' ' . $currencyNames[0];

        if (null !== $fraction) {
            $return .= ' ' . trim($numberTransformer->toWords($fraction)) . ' ' . $currencyNames[1];
        }

        return $return;
    }
}

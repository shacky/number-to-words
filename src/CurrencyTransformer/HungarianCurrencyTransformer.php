<?php

namespace NumberToWords\CurrencyTransformer;

use NumberToWords\Exception\NumberToWordsException;
use NumberToWords\Language\Hungarian\HungarianDictionary;
use NumberToWords\Language\Hungarian\HungarianExponentGetter;
use NumberToWords\Language\Hungarian\HungarianTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;

class HungarianCurrencyTransformer implements CurrencyTransformer
{
    use CurrencySubunitSplitter;

    public function toWords(int $amount, string $currency, ?CurrencyTransformerOptions $options = null): string
    {
        $dictionary = new HungarianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new HungarianTripletTransformer($dictionary);
        $exponentGetter = new HungarianExponentGetter();

        [$decimal, $fraction] = $this->splitAmount($amount, $currency);

        if ($fraction === 0) {
            $fraction = null;
        }

        $currency = strtoupper($currency);

        if (!array_key_exists($currency, HungarianDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currency, get_class($this))
            );
        }

        $currencyNames = HungarianDictionary::$currencyNames[$currency];

        // Build number transformer with conditional separator for decimal part
        $builder = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy('')
            ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
            ->useRegularExponents($exponentGetter);

        if ($decimal >= 2000 || $decimal <= -2000) {
            $builder = $builder->withExponentsSeparatedBy('-');
        }

        $numberTransformer = $builder->build();

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
            // Rebuild transformer for fraction part with conditional separator
            $builder = (new NumberTransformerBuilder())
                ->withDictionary($dictionary)
                ->withWordsSeparatedBy('')
                ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
                ->useRegularExponents($exponentGetter);

            if ($fraction >= 2000 || $fraction <= -2000) {
                $builder = $builder->withExponentsSeparatedBy('-');
            }

            $fractionTransformer = $builder->build();

            $return .= ' ' . trim($fractionTransformer->toWords($fraction));

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

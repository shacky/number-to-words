<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\French\BelgianFrenchDictionary;
use NumberToWords\Language\French\BelgianFrenchTripletTransformer;
use NumberToWords\Language\French\BelgianFrenchExponentInflector;
use NumberToWords\Service\NumberToTripletsConverter;

class FrenchBelgianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new BelgianFrenchDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new BelgianFrenchTripletTransformer($dictionary);
        $exponentInflector = new BelgianFrenchExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

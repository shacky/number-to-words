<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\BelgianFrench\BelgianFrenchDictionary;
use NumberToWords\Language\BelgianFrench\BelgianFrenchExponentInflector;
use NumberToWords\Language\BelgianFrench\BelgianFrenchTripletTransformer;
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

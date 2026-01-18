<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\French\FrenchDictionary;
use NumberToWords\Language\French\FrenchTripletTransformer;
use NumberToWords\Language\French\FrenchExponentInflector;
use NumberToWords\Service\NumberToTripletsConverter;

class FrenchNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
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

        return $numberTransformer->toWords($number);
    }
}

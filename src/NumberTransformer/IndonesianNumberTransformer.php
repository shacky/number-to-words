<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Indonesian\IndonesianDictionary;
use NumberToWords\Language\Indonesian\IndonesianExponentInflector;
use NumberToWords\Language\Indonesian\IndonesianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class IndonesianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new IndonesianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new IndonesianTripletTransformer($dictionary);
        $exponentInflector = new IndonesianExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

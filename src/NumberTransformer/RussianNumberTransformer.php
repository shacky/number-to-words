<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Russian\RussianDictionary;
use NumberToWords\Language\Russian\RussianExponentInflector;
use NumberToWords\Language\Russian\RussianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class RussianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new RussianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new RussianTripletTransformer($dictionary);
        $exponentInflector = new RussianExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

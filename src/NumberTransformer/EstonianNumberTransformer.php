<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Estonian\EstonianDictionary;
use NumberToWords\Language\Estonian\EstonianExponentInflector;
use NumberToWords\Language\Estonian\EstonianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class EstonianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new EstonianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new EstonianTripletTransformer($dictionary);
        $exponentInflector = new EstonianExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

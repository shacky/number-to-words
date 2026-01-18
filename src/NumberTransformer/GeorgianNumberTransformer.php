<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Georgian\GeorgianDictionary;
use NumberToWords\Language\Georgian\GeorgianExponentInflector;
use NumberToWords\Language\Georgian\GeorgianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class GeorgianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new GeorgianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new GeorgianTripletTransformer($dictionary);
        $exponentInflector = new GeorgianExponentInflector($dictionary);

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

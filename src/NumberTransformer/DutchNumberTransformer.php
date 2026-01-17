<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Dutch\DutchDictionary;
use NumberToWords\Language\Dutch\DutchExponentInflector;
use NumberToWords\Language\Dutch\DutchTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class DutchNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new DutchDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new DutchTripletTransformer($dictionary);
        $exponentInflector = new DutchExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy('')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

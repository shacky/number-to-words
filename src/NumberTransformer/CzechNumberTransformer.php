<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Czech\CzechDictionary;
use NumberToWords\Language\Czech\CzechExponentInflector;
use NumberToWords\Language\Czech\CzechNounGenderInflector;
use NumberToWords\Language\Czech\CzechTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class CzechNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new CzechDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new CzechTripletTransformer($dictionary);
        $exponentInflector = new CzechExponentInflector(new CzechNounGenderInflector());

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

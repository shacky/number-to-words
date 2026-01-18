<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Lithuanian\LithuanianDictionary;
use NumberToWords\Language\Lithuanian\LithuanianExponentInflector;
use NumberToWords\Language\Lithuanian\LithuanianNounGenderInflector;
use NumberToWords\Language\Lithuanian\LithuanianTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;

class LithuanianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new LithuanianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new LithuanianTripletTransformer($dictionary);
        $exponentInflector = new LithuanianExponentInflector(new LithuanianNounGenderInflector());

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

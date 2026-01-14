<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Ukrainian\UkrainianDictionary;
use NumberToWords\Language\Ukrainian\UkrainianExponentInflector;
use NumberToWords\Language\Ukrainian\UkrainianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class UkrainianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new UkrainianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new UkrainianTripletTransformer($dictionary);
        $exponentInflector = new UkrainianExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Swahili\SwahiliDictionary;
use NumberToWords\Language\Swahili\SwahiliNumberToTripletsConverter;
use NumberToWords\Language\Swahili\SwahiliTripletTransformer;

class SwahiliNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new SwahiliDictionary();
        $numberToTripletsConverter = new SwahiliNumberToTripletsConverter();
        $tripletTransformer = new SwahiliTripletTransformer($dictionary);

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(', ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

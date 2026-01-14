<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Swedish\SwedishDictionary;
use NumberToWords\Language\Swedish\SwedishExponentGetter;
use NumberToWords\Language\Swedish\SwedishTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class SwedishNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new SwedishDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new SwedishTripletTransformer($dictionary);
        $exponentGetter = new SwedishExponentGetter();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
            ->useRegularExponents($exponentGetter)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

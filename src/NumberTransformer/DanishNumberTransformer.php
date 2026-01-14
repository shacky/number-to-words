<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Danish\DanishDictionary;
use NumberToWords\Language\Danish\DanishExponentGetter;
use NumberToWords\Language\Danish\DanishTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class DanishNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new DanishDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new DanishTripletTransformer($dictionary);
        $exponentGetter = new DanishExponentGetter();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
            ->useRegularExponents($exponentGetter)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

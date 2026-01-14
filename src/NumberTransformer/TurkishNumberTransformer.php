<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Turkish\TurkishDictionary;
use NumberToWords\Language\Turkish\TurkishExponentGetter;
use NumberToWords\Language\Turkish\TurkishTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class TurkishNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new TurkishDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new TurkishTripletTransformer($dictionary);
        $exponentGetter = new TurkishExponentGetter();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->useRegularExponents($exponentGetter)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

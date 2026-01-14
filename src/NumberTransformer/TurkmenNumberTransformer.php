<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Turkmen\TurkmenDictionary;
use NumberToWords\Language\Turkmen\TurkmenExponentGetter;
use NumberToWords\Language\Turkmen\TurkmenTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class TurkmenNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new TurkmenDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new TurkmenTripletTransformer($dictionary);
        $exponentGetter = new TurkmenExponentGetter();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
            ->useRegularExponents($exponentGetter)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Spanish\SpanishDictionary;
use NumberToWords\Language\Spanish\SpanishExponentInflector;
use NumberToWords\Language\Spanish\SpanishTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class SpanishNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new SpanishDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new SpanishTripletTransformer($dictionary);
        $exponentInflector = new SpanishExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

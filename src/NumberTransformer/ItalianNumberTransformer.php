<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Italian\ItalianDictionary;
use NumberToWords\Language\Italian\ItalianExponentInflector;
use NumberToWords\Language\Italian\ItalianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class ItalianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new ItalianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new ItalianTripletTransformer($dictionary);
        $exponentInflector = new ItalianExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy('')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

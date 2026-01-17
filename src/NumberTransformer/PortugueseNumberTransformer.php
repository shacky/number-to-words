<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Portuguese\PortugueseDictionary;
use NumberToWords\Language\Portuguese\PortugueseExponentInflector;
use NumberToWords\Language\Portuguese\PortugueseTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class PortugueseNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new PortugueseDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new PortugueseTripletTransformer($dictionary);
        $exponentInflector = new PortugueseExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

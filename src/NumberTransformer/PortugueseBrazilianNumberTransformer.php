<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\PortugueseBrazilian\PortugueseBrazilianDictionary;
use NumberToWords\Language\PortugueseBrazilian\PortugueseBrazilianExponentInflector;
use NumberToWords\Language\PortugueseBrazilian\PortugueseBrazilianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class PortugueseBrazilianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new PortugueseBrazilianDictionary();
        $tripletTransformer = new PortugueseBrazilianTripletTransformer($dictionary);
        $exponentInflector = new PortugueseBrazilianExponentInflector();
        $numberToTripletsConverter = new NumberToTripletsConverter();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

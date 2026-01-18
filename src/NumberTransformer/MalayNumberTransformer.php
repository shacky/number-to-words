<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Malay\MalayDictionary;
use NumberToWords\Language\Malay\MalayExponentInflector;
use NumberToWords\Language\Malay\MalayTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class MalayNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new MalayDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new MalayTripletTransformer($dictionary);
        $exponentInflector = new MalayExponentInflector();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

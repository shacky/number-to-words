<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Yoruba\YorubaDictionary;
use NumberToWords\Language\Yoruba\YorubaTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class YorubaNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new YorubaDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new YorubaTripletTransformer($dictionary);

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(', ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

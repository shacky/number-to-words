<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Grammar\Gender;
use NumberToWords\Language\Romanian\Dictionary;
use NumberToWords\Language\Romanian\RomanianExponentInflector;
use NumberToWords\Language\Romanian\RomanianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class RomanianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new Dictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = (new RomanianTripletTransformer($dictionary))
            ->setGrammaticalGender(Gender::GENDER_ABSTRACT);
        $exponentInflector = new RomanianExponentInflector($dictionary);

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy($dictionary->getWordSeparator())
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Grammar\Gender;
use NumberToWords\Language\Macedonian\MacedonianDictionary;
use NumberToWords\Language\Macedonian\MacedonianExponentInflector;
use NumberToWords\Language\Macedonian\MacedonianTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;
use NumberToWords\Service\NumberToTripletsConverter;

class MacedonianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new MacedonianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = (new MacedonianTripletTransformer($dictionary))
            ->setGrammaticalGender(Gender::GENDER_MASCULINE);
        $exponentInflector = new MacedonianExponentInflector($dictionary);

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoPowerAwareTriplets($numberToTripletsConverter, $tripletTransformer)
            ->inflectExponentByNumbers($exponentInflector)
            ->build();

        return $numberTransformer->toWords($number);
    }
}

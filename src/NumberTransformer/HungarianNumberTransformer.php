<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\Hungarian\HungarianDictionary;
use NumberToWords\Language\Hungarian\HungarianExponentGetter;
use NumberToWords\Language\Hungarian\HungarianTripletTransformer;
use NumberToWords\Service\NumberToTripletsConverter;

class HungarianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new HungarianDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new HungarianTripletTransformer($dictionary);
        $exponentGetter = new HungarianExponentGetter();

        // Hungarian uses "" separator between triplet and exponent
        // For numbers >= 2000 or <= -2000, use "-" between triplet groups
        $builder = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy('')
            ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
            ->useRegularExponents($exponentGetter);

        if ($number >= 2000 || $number <= -2000) {
            $builder = $builder->withExponentsSeparatedBy('-');
        }

        $numberTransformer = $builder->build();

        return $numberTransformer->toWords($number);
    }
}

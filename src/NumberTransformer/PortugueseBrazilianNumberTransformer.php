<?php

namespace NumberToWords\NumberTransformer;

use NumberToWords\Language\PortugueseBrazilian\PortugueseBrazilianDictionary;
use NumberToWords\Language\PortugueseBrazilian\PortugueseBrazilianExponentInflector;
use NumberToWords\Language\PortugueseBrazilian\PortugueseBrazilianTripletTransformer;
use NumberToWords\NumberTransformer\NumberTransformerBuilder;

class PortugueseBrazilianNumberTransformer implements NumberTransformer
{
    public function toWords(int $number): string
    {
        $dictionary = new PortugueseBrazilianDictionary();
        $tripletTransformer = new PortugueseBrazilianTripletTransformer($dictionary);
        $exponentInflector = new PortugueseBrazilianExponentInflector();

        return (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withTripletTransformer($tripletTransformer)
            ->withExponentInflector($exponentInflector)
            ->transformToWords($number);
    }
}

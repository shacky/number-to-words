<?php

namespace NumberToWords\Language\Lithuanian;

use NumberToWords\Language\ExponentInflector;

class LithuanianExponentInflector implements ExponentInflector
{
    private LithuanianNounGenderInflector $inflector;

    public function __construct(LithuanianNounGenderInflector $inflector)
    {
        $this->inflector = $inflector;
    }

    public function inflectExponent(int $number, int $power): string
    {
        $exponentForms = LithuanianDictionary::$exponent[$power];

        return $this->inflector->inflectNounByNumber(
            $number,
            $exponentForms[0],
            $exponentForms[1],
            $exponentForms[2]
        );
    }
}

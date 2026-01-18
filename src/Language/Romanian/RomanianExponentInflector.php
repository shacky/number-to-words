<?php

namespace NumberToWords\Language\Romanian;

use NumberToWords\Language\ExponentInflector;

class RomanianExponentInflector implements ExponentInflector
{
    private Dictionary $dictionary;

    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function inflectExponent(int $number, int $power): string
    {
        if ($power === 0) {
            return '';
        }

        $exponent = $this->dictionary->getExponentByPower($power * 3);

        if (!is_array($exponent)) {
            return '';
        }

        return $this->dictionary->getNounDeclensionForNumber($number, $exponent);
    }
}

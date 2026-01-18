<?php

namespace NumberToWords\Language\Georgian;

use NumberToWords\Language\ExponentInflector;

class GeorgianExponentInflector implements ExponentInflector
{
    private GeorgianDictionary $dictionary;

    public function __construct(GeorgianDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function inflectExponent(int $number, int $power): string
    {
        if ($power === 0) {
            return '';
        }

        $exponent = $this->dictionary->getExponent($power);

        // Always return the exponent without extra spacing
        // (spacing is handled by the builder's separator)
        return $exponent;
    }
}

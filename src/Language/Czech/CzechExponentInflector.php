<?php

namespace NumberToWords\Language\Czech;

use NumberToWords\Language\ExponentInflector;

class CzechExponentInflector implements ExponentInflector
{
    private static array $exponent = [
        ['', '', ''],
        ['tisíc', 'tisíce', 'tisíc'],
        ['milión', 'milióny', 'miliónů'],
        ['miliarda', 'miliardy', 'miliard'],
        ['bilion', 'biliony', 'bilionů'],
        ['biliarda', 'biliardy', 'biliard'],
        ['trilion', 'triliony', 'trilionů'],
        ['triliarda', 'triliardy', 'triliard'],
    ];

    private CzechNounGenderInflector $inflector;

    public function __construct(CzechNounGenderInflector $inflector)
    {
        $this->inflector = $inflector;
    }

    public function inflectExponent(int $number, int $power): string
    {
        return $this->inflector->inflectNounByNumber(
            $number,
            self::$exponent[$power][0],
            self::$exponent[$power][1],
            self::$exponent[$power][2]
        );
    }
}

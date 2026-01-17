<?php

namespace NumberToWords\Language\PortugueseBrazilian;

use NumberToWords\Language\PowerAwareExponentInflector;

class PortugueseBrazilianExponentInflector implements PowerAwareExponentInflector
{
    /** @var array<int, array{string, string}> Exponents: [singular, plural] */
    private static array $exponents = [
        0 => ['', ''],
        1 => ['mil', 'mil'],  // "mil" doesn't pluralize in Portuguese
        2 => ['milhão', 'milhões'],
        3 => ['bilhão', 'bilhões'],  // Brazilian Portuguese uses short scale
        4 => ['trilhão', 'trilhões'],
        5 => ['quatrilhão', 'quatrilhões'],
        6 => ['quintilhão', 'quintilhões'],
        7 => ['sextilhão', 'sextilhões'],
        8 => ['septilhão', 'septilhões'],
        9 => ['octilhão', 'octilhões'],
        10 => ['nonilhão', 'nonilhões'],
        11 => ['decilhão', 'decilhões'],
        12 => ['undecilhão', 'undecilhões'],
        13 => ['dodecilhão', 'dodecilhões'],
        14 => ['tredecilhão', 'tredecilhões'],
        15 => ['quatuordecilhão', 'quatuordecilhões'],
        16 => ['quindecilhão', 'quindecilhões'],
        17 => ['sedecilhão', 'sedecilhões'],
        18 => ['septendecilhão', 'septendecilhões'],
    ];

    public function inflectExponent(int $power, int $number): string
    {
        if (!isset(self::$exponents[$power])) {
            return '';
        }

        $exponent = self::$exponents[$power];
        
        // Use plural form when number > 1
        return $number > 1 ? $exponent[1] : $exponent[0];
    }
}

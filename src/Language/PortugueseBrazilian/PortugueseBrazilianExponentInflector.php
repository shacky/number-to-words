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

    public function inflectExponent(int $number, int $power): string
    {
        return $this->inflectExponentWithContext($number, $power, $power, 1);
    }

    public function inflectExponentWithContext(
        int $number,
        int $power,
        int $maxPower,
        int $nonZeroTripletCount
    ): string {
        if ($power === 0 || !isset(self::$exponents[$power])) {
            return '';
        }

        [$singular, $plural] = self::$exponents[$power];

        // "mil" never pluralizes; others pluralize when the triplet is > 1
        if ($power === 1) {
            return $singular;
        }

        return $number > 1 ? $plural : $singular;
    }
}

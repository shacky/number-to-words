<?php

namespace NumberToWords\Language\French;

use NumberToWords\Language\ExponentInflector;

class FrenchExponentInflector implements ExponentInflector
{
    private static array $exponents = [
        0 => '',
        3 => 'mille',
        6 => 'million',
        9 => 'milliard',
        12  => 'billion',
        15  => 'billiard',
        18  => 'trillion',
        21  => 'trilliard',
        24  => 'quadrillion',
        27  => 'quadrillard',
        30  => 'quintillion',
        33  => 'quintilliard',
        36  => 'sextillion',
        39  => 'sextilliard',
        42  => 'septillion',
        45  => 'septilliard',
        48  => 'octillion',
        51  => 'octilliard',
        54  => 'nonillion',
        57  => 'nonilliard',
        60  => 'décillion',
        63  => 'décilliard',
        66  => 'undécillion',
        69  => 'undécilliard',
        72  => 'duodécillion',
        75  => 'duodécilliard',
        78  => 'trédécillion',
        81  => 'trédéciliard',
        84  => 'quattuordécillion',
        87  => 'quattuordécilliard',
        90  => 'quindécillion',
        93  => 'quindécilliard',
        96  => 'sexdécillion',
        99  => 'sexdécilliard',
        102  => 'septendécillion',
        105  => 'septendécilliard',
        108  => 'octodécillion',
        111  => 'octodécilliard',
        114  => 'novemdécillion',
        117  => 'novemdécilliard',
        120  => 'vingtillion',
        123  => 'vingtilliard',
    ];

    public function inflectExponent(int $number, int $power): string
    {
        $exponent = self::$exponents[$power * 3] ?? '';

        // Add plural 's' for millions, billions, etc. (but not for "mille")
        if ($power > 1 && $number > 1 && $exponent !== '') {
            $exponent .= 's';
        }

        return $exponent;
    }
}

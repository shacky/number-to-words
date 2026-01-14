<?php

namespace NumberToWords\Language\Hungarian;

use NumberToWords\Language\ExponentGetter;

class HungarianExponentGetter implements ExponentGetter
{
    private static array $exponents = [
        0 => '',
        1 => 'ezer',
        2 => 'millió',
        3 => 'milliárd',
        4 => 'billió',
        5 => 'billiárd',
        6 => 'trillió',
        7 => 'trilliárd',
        8 => 'kvadrillió',
        9 => 'kvadrilliárd',
        10 => 'kvintillió',
        11 => 'kvintilliárd',
        12 => 'szextillió',
        13 => 'szextilliárd',
        14 => 'szeptillió',
        15 => 'szeptilliárd',
        16 => 'oktillió',
        17 => 'oktilliárd',
        18 => 'nonillió',
        19 => 'nonilliárd',
        20 => 'decillió',
        21 => 'decilliárd',
    ];

    public function getExponent(int $power): string
    {
        return self::$exponents[$power] ?? '';
    }
}

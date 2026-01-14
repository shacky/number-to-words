<?php

namespace NumberToWords\Language\Hungarian;

use NumberToWords\Language\Dictionary;

class HungarianDictionary implements Dictionary
{
    public const LOCALE = 'hu';
    public const LANGUAGE_NAME = 'Hungarian';
    public const LANGUAGE_NAME_NATIVE = 'Magyar';

    private static array $units = [
        0 => '',
        1 => 'egy',
        2 => 'kettő',
        3 => 'három',
        4 => 'négy',
        5 => 'öt',
        6 => 'hat',
        7 => 'hét',
        8 => 'nyolc',
        9 => 'kilenc',
    ];

    public function getZero(): string
    {
        return 'nulla';
    }

    public function getMinus(): string
    {
        return 'mínusz';
    }

    public function getCorrespondingUnit(int $unit): string
    {
        return self::$units[$unit];
    }

    public function getCorrespondingTen(int $ten): string
    {
        // Hungarian tens are irregular and handled in transformer
        return '';
    }

    public function getCorrespondingTeen(int $teen): string
    {
        // Hungarian teens are handled in transformer (tizen + unit)
        return '';
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        // Hungarian hundreds are handled in transformer (unit + száz)
        return '';
    }
}

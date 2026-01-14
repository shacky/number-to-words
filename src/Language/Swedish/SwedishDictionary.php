<?php

namespace NumberToWords\Language\Swedish;

use NumberToWords\Language\Dictionary;

class SwedishDictionary implements Dictionary
{
    public const LOCALE = 'sv';
    public const LANGUAGE_NAME = 'Swedish';
    public const LANGUAGE_NAME_NATIVE = 'Svenska';

    private static array $units = [
        0 => '',
        1 => 'en',
        2 => 'två',
        3 => 'tre',
        4 => 'fyra',
        5 => 'fem',
        6 => 'sex',
        7 => 'sju',
        8 => 'åtta',
        9 => 'nio',
    ];

    private static array $teens = [
        0 => 'tio',
        1 => 'elva',
        2 => 'tolv',
        3 => 'tretton',
        4 => 'fjorton',
        5 => 'femton',
        6 => 'sexton',
        7 => 'sjutton',
        8 => 'arton',
        9 => 'nitton',
    ];

    private static array $tens = [
        0 => '',
        1 => 'tio',
        2 => 'tjugo',
        3 => 'trettio',
        4 => 'fyrtio',
        5 => 'femtio',
        6 => 'sextio',
        7 => 'sjuttio',
        8 => 'åttio',
        9 => 'nittio',
    ];

    public function getZero(): string
    {
        return 'noll';
    }

    public function getMinus(): string
    {
        return 'Minus';
    }

    public function getCorrespondingUnit(int $unit): string
    {
        return self::$units[$unit];
    }

    public function getCorrespondingTen(int $ten): string
    {
        return self::$tens[$ten];
    }

    public function getCorrespondingTeen(int $teen): string
    {
        return self::$teens[$teen];
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        // Swedish uses "unit + hundra"
        return '';
    }
}

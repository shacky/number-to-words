<?php

namespace NumberToWords\Language\Danish;

use NumberToWords\Language\Dictionary;

class DanishDictionary implements Dictionary
{
    public const LOCALE = 'dk';
    public const LANGUAGE_NAME = 'Danish';
    public const LANGUAGE_NAME_NATIVE = 'Dansk';

    private static array $units = [
        0 => '',
        1 => 'en',
        2 => 'to',
        3 => 'tre',
        4 => 'fire',
        5 => 'fem',
        6 => 'seks',
        7 => 'syv',
        8 => 'otte',
        9 => 'ni',
    ];

    private static array $teens = [
        0 => 'ti',
        1 => 'elleve',
        2 => 'tolv',
        3 => 'tretten',
        4 => 'fjorten',
        5 => 'femten',
        6 => 'seksten',
        7 => 'sytten',
        8 => 'atten',
        9 => 'nitten',
    ];

    private static array $tens = [
        0 => '',
        1 => 'ti',
        2 => 'tyve',
        3 => 'tredive',
        4 => 'fyrre',
        5 => 'halvtreds',
        6 => 'tres',
        7 => 'halvfjerds',
        8 => 'firs',
        9 => 'halvfems',
    ];

    public function getZero(): string
    {
        return 'nul';
    }

    public function getMinus(): string
    {
        return 'minus';
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
        return '';
    }
}

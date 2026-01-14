<?php

namespace NumberToWords\Language\Estonian;

use NumberToWords\Language\Dictionary;

class EstonianDictionary implements Dictionary
{
    public const LOCALE = 'et';
    public const LANGUAGE_NAME = 'Estonian';
    public const LANGUAGE_NAME_NATIVE = 'eesti keel';

    private static array $units = [
        0 => '',
        1 => 'üks',
        2 => 'kaks',
        3 => 'kolm',
        4 => 'neli',
        5 => 'viis',
        6 => 'kuus',
        7 => 'seitse',
        8 => 'kaheksa',
        9 => 'üheksa',
    ];

    private static array $teens = [
        0 => 'kümme',
        1 => 'üksteist',
        2 => 'kaksteist',
        3 => 'kolmteist',
        4 => 'neliteist',
        5 => 'viisteist',
        6 => 'kuusteist',
        7 => 'seitseteist',
        8 => 'kaheksateist',
        9 => 'üheksateist',
    ];

    private static array $tens = [
        0 => '',
        1 => 'kümme',
        2 => 'kakskümmend',
        3 => 'kolmkümmend',
        4 => 'nelikümmend',
        5 => 'viiskümmend',
        6 => 'kuuskümmend',
        7 => 'seitsekümmend',
        8 => 'kaheksakümmend',
        9 => 'üheksakümmend',
    ];

    public function getZero(): string
    {
        return 'null';
    }

    public function getMinus(): string
    {
        return 'miinus';
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
        // Estonian uses "unit + sada"
        return '';
    }
}

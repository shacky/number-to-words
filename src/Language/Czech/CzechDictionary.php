<?php

namespace NumberToWords\Language\Czech;

use NumberToWords\Language\Dictionary;

class CzechDictionary implements Dictionary
{
    public const LOCALE = 'cs';
    public const LANGUAGE_NAME = 'Czech';
    public const LANGUAGE_NAME_NATIVE = 'čeština';

    private static array $units = [
        0 => '',
        1 => 'jedna',
        2 => 'dva',
        3 => 'tři',
        4 => 'čtyři',
        5 => 'pět',
        6 => 'šest',
        7 => 'sedm',
        8 => 'osm',
        9 => 'devět',
    ];

    private static array $teens = [
        0 => 'deset',
        1 => 'jedenáct',
        2 => 'dvanáct',
        3 => 'třináct',
        4 => 'čtrnáct',
        5 => 'patnáct',
        6 => 'šestnáct',
        7 => 'sedmnáct',
        8 => 'osmnáct',
        9 => 'devatenáct'
    ];

    private static array $tens = [
        0 => '',
        1 => 'deset',
        2 => 'dvacet',
        3 => 'třicet',
        4 => 'čtyřicet',
        5 => 'padesát',
        6 => 'šedesát',
        7 => 'sedmdesát',
        8 => 'osmdesát',
        9 => 'devadesát'
    ];

    private static array $hundreds = [
        0 => '',
        1 => 'sto',
        2 => 'dvě stě',
        3 => 'tři sta',
        4 => 'čtyři sta',
        5 => 'pět set',
        6 => 'šest set',
        7 => 'sedm set',
        8 => 'osm set',
        9 => 'devět set'
    ];

    private static array $exponents = [
        0 => ['', '', ''],
        1 => ['tisíc', 'tisíce', 'tisíc'],
        2 => ['milión', 'milióny', 'miliónů'],
        3 => ['miliarda', 'miliardy', 'miliard'],
        4 => ['bilion', 'biliony', 'bilionů'],
        5 => ['biliarda', 'biliardy', 'biliard'],
    ];

    public function getZero(): string
    {
        return 'nula';
    }

    public function getMinus(): string
    {
        return 'mínus';
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
        return self::$hundreds[$hundred];
    }

    public function getExponent(int $power, int $form): string
    {
        return self::$exponents[$power][$form] ?? '';
    }
}

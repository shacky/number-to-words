<?php

namespace NumberToWords\Language\Indonesian;

use NumberToWords\Language\Dictionary;

class IndonesianDictionary implements Dictionary
{
    public const LOCALE = 'id';
    public const LANGUAGE_NAME = 'Indonesian';
    public const LANGUAGE_NAME_NATIVE = 'Bahasa Indonesia';

    private static array $units = [
        0 => '',
        1 => 'satu',
        2 => 'dua',
        3 => 'tiga',
        4 => 'empat',
        5 => 'lima',
        6 => 'enam',
        7 => 'tujuh',
        8 => 'delapan',
        9 => 'sembilan',
    ];

    private static array $teens = [
        0 => 'sepuluh',
        1 => 'sebelas',
        2 => 'dua belas',
        3 => 'tiga belas',
        4 => 'empat belas',
        5 => 'lima belas',
        6 => 'enam belas',
        7 => 'tujuh belas',
        8 => 'delapan belas',
        9 => 'sembilan belas',
    ];

    private static array $tens = [
        0 => '',
        1 => 'sepuluh',
        2 => 'dua puluh',
        3 => 'tiga puluh',
        4 => 'empat puluh',
        5 => 'lima puluh',
        6 => 'enam puluh',
        7 => 'tujuh puluh',
        8 => 'delapan puluh',
        9 => 'sembilan puluh',
    ];

    private static array $hundreds = [
        0 => '',
        1 => 'seratus',
        2 => 'dua ratus',
        3 => 'tiga ratus',
        4 => 'empat ratus',
        5 => 'lima ratus',
        6 => 'enam ratus',
        7 => 'tujuh ratus',
        8 => 'delapan ratus',
        9 => 'sembilan ratus',
    ];

    public function getZero(): string
    {
        return 'nol';
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
        return self::$hundreds[$hundred];
    }
}

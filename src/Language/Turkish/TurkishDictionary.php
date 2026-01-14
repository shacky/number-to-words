<?php

namespace NumberToWords\Language\Turkish;

use NumberToWords\Language\Dictionary;

class TurkishDictionary implements Dictionary
{
    public const LOCALE = 'tr';
    public const LANGUAGE_NAME = 'Turkish';
    public const LANGUAGE_NAME_NATIVE = 'Türkçe';

    private static array $units = [
        0 => '',
        1 => 'bir',
        2 => 'iki',
        3 => 'üç',
        4 => 'dört',
        5 => 'beş',
        6 => 'altı',
        7 => 'yedi',
        8 => 'sekiz',
        9 => 'dokuz',
    ];

    private static array $tens = [
        0 => '',
        1 => 'on',
        2 => 'yirmi',
        3 => 'otuz',
        4 => 'kırk',
        5 => 'elli',
        6 => 'altmış',
        7 => 'yetmiş',
        8 => 'seksen',
        9 => 'doksan',
    ];

    public function getZero(): string
    {
        return 'sıfır';
    }

    public function getMinus(): string
    {
        return 'eksi';
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
        // Turkish doesn't have special teen words, just "on" + unit
        return '';
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        // Turkish doesn't use this - hundreds are handled differently
        return '';
    }
}

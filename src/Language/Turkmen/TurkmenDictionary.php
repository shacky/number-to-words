<?php

namespace NumberToWords\Language\Turkmen;

use NumberToWords\Language\Dictionary;

class TurkmenDictionary implements Dictionary
{
    public const LOCALE = 'tk';
    public const LANGUAGE_NAME = 'Turkmen';
    public const LANGUAGE_NAME_NATIVE = 'Türkmen';

    private static array $units = [
        0 => '',
        1 => 'bir',
        2 => 'iki',
        3 => 'üç',
        4 => 'dört',
        5 => 'bäş',
        6 => 'alty',
        7 => 'ýedi',
        8 => 'sekiz',
        9 => 'dokuz',
    ];

    private static array $tens = [
        0 => '',
        1 => 'on',
        2 => 'ýigrimi',
        3 => 'otuz',
        4 => 'kyrk',
        5 => 'elli',
        6 => 'altmyş',
        7 => 'ýetmiş',
        8 => 'segsen',
        9 => 'togsan',
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
        return '';
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        return '';
    }
}

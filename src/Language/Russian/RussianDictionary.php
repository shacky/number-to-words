<?php

namespace NumberToWords\Language\Russian;

use NumberToWords\Language\Dictionary;

class RussianDictionary implements Dictionary
{
    public const LOCALE = 'ru';
    public const LANGUAGE_NAME = 'Russian';
    public const LANGUAGE_NAME_NATIVE = 'Русский';

    // Male gender units
    private static array $unitsMale = [
        0 => '',
        1 => 'один',
        2 => 'два',
        3 => 'три',
        4 => 'четыре',
        5 => 'пять',
        6 => 'шесть',
        7 => 'семь',
        8 => 'восемь',
        9 => 'девять',
    ];

    // Female gender units (used for thousands)
    private static array $unitsFemale = [
        0 => '',
        1 => 'одна',
        2 => 'две',
        3 => 'три',
        4 => 'четыре',
        5 => 'пять',
        6 => 'шесть',
        7 => 'семь',
        8 => 'восемь',
        9 => 'девять',
    ];

    private static array $teens = [
        0 => 'десять',
        1 => 'одиннадцать',
        2 => 'двенадцать',
        3 => 'тринадцать',
        4 => 'четырнадцать',
        5 => 'пятнадцать',
        6 => 'шестнадцать',
        7 => 'семнадцать',
        8 => 'восемнадцать',
        9 => 'девятнадцать',
    ];

    private static array $tens = [
        0 => '',
        1 => 'десять',
        2 => 'двадцать',
        3 => 'тридцать',
        4 => 'сорок',
        5 => 'пятьдесят',
        6 => 'шестьдесят',
        7 => 'семьдесят',
        8 => 'восемьдесят',
        9 => 'девяносто',
    ];

    private static array $hundreds = [
        0 => '',
        1 => 'сто',
        2 => 'двести',
        3 => 'триста',
        4 => 'четыреста',
        5 => 'пятьсот',
        6 => 'шестьсот',
        7 => 'семьсот',
        8 => 'восемьсот',
        9 => 'девятьсот',
    ];

    public function getZero(): string
    {
        return 'ноль';
    }

    public function getMinus(): string
    {
        return 'минус';
    }

    public function getCorrespondingUnit(int $unit): string
    {
        return self::$unitsMale[$unit];
    }

    public function getCorrespondingUnitFemale(int $unit): string
    {
        return self::$unitsFemale[$unit];
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

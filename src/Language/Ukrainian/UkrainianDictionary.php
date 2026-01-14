<?php

namespace NumberToWords\Language\Ukrainian;

use NumberToWords\Language\Dictionary;

class UkrainianDictionary implements Dictionary
{
    public const LOCALE = 'ua';
    public const LANGUAGE_NAME = 'Ukrainian';
    public const LANGUAGE_NAME_NATIVE = 'Українська';

    // Male gender units
    private static array $unitsMale = [
        0 => '',
        1 => 'один',
        2 => 'два',
        3 => 'три',
        4 => 'чотири',
        5 => 'п\'ять',
        6 => 'шість',
        7 => 'сім',
        8 => 'вісім',
        9 => 'дев\'ять',
    ];

    // Female gender units (used for thousands)
    private static array $unitsFemale = [
        0 => '',
        1 => 'одна',
        2 => 'дві',
        3 => 'три',
        4 => 'чотири',
        5 => 'п\'ять',
        6 => 'шість',
        7 => 'сім',
        8 => 'вісім',
        9 => 'дев\'ять',
    ];

    private static array $teens = [
        0 => 'десять',
        1 => 'одинадцять',
        2 => 'дванадцять',
        3 => 'тринадцять',
        4 => 'чотирнадцять',
        5 => 'п\'ятнадцять',
        6 => 'шістнадцять',
        7 => 'сімнадцять',
        8 => 'вісімнадцять',
        9 => 'дев\'ятнадцять',
    ];

    private static array $tens = [
        0 => '',
        1 => 'десять',
        2 => 'двадцять',
        3 => 'тридцять',
        4 => 'сорок',
        5 => 'п\'ятдесят',
        6 => 'шістдесят',
        7 => 'сімдесят',
        8 => 'вісімдесят',
        9 => 'дев\'яносто',
    ];

    private static array $hundreds = [
        0 => '',
        1 => 'сто',
        2 => 'двісті',
        3 => 'триста',
        4 => 'чотириста',
        5 => 'п\'ятсот',
        6 => 'шістсот',
        7 => 'сімсот',
        8 => 'вісімсот',
        9 => 'дев\'ятсот',
    ];

    public function getZero(): string
    {
        return 'нуль';
    }

    public function getMinus(): string
    {
        return 'мінус';
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

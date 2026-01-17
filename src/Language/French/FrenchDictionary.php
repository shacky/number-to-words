<?php

namespace NumberToWords\Language\French;

use NumberToWords\Language\Dictionary;

class FrenchDictionary implements Dictionary
{
    public const LOCALE = 'fr';
    public const LANGUAGE_NAME = 'French';
    public const LANGUAGE_NAME_NATIVE = 'Français';

    private static array $units = [
        0 => '',
        1 => 'un',
        2 => 'deux',
        3 => 'trois',
        4 => 'quatre',
        5 => 'cinq',
        6 => 'six',
        7 => 'sept',
        8 => 'huit',
        9 => 'neuf',
    ];

    private static array $teens = [
        0 => 'dix',
        1 => 'onze',
        2 => 'douze',
        3 => 'treize',
        4 => 'quatorze',
        5 => 'quinze',
        6 => 'seize',
        7 => 'dix-sept',
        8 => 'dix-huit',
        9 => 'dix-neuf',
    ];

    private static array $tens = [
        0 => '',
        1 => 'dix',
        2 => 'vingt',
        3 => 'trente',
        4 => 'quarante',
        5 => 'cinquante',
        6 => 'soixante',
        7 => 'soixante',  // 70s use soixante + teens
        8 => 'quatre-vingt',  // 80s use quatre-vingt
        9 => 'quatre-vingt',  // 90s use quatre-vingt + teens
    ];

    public function getZero(): string
    {
        return 'zéro';
    }

    public function getMinus(): string
    {
        return 'moins';
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

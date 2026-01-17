<?php

namespace NumberToWords\Language\Dutch;

use NumberToWords\Language\Dictionary;

class DutchDictionary implements Dictionary
{
    public const LOCALE = 'nl';
    public const LANGUAGE_NAME = 'Dutch';
    public const LANGUAGE_NAME_NATIVE = 'Nederlands';

    private static array $units = [
        0 => '',
        1 => 'één',
        2 => 'twee',
        3 => 'drie',
        4 => 'vier',
        5 => 'vijf',
        6 => 'zes',
        7 => 'zeven',
        8 => 'acht',
        9 => 'negen',
    ];

    private static array $teens = [
        0 => 'tien',
        1 => 'elf',
        2 => 'twaalf',
        3 => 'dertien',
        4 => 'veertien',
        5 => 'vijftien',
        6 => 'zestien',
        7 => 'zeventien',
        8 => 'achttien',
        9 => 'negentien',
    ];

    private static array $tens = [
        0 => '',
        1 => 'tien',
        2 => 'twintig',
        3 => 'dertig',
        4 => 'veertig',
        5 => 'vijftig',
        6 => 'zestig',
        7 => 'zeventig',
        8 => 'tachtig',
        9 => 'negentig',
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

<?php

namespace NumberToWords\Language\Spanish;

use NumberToWords\Language\Dictionary;

class SpanishDictionary implements Dictionary
{
    public const LOCALE = 'es';
    public const LANGUAGE_NAME = 'Spanish';
    public const LANGUAGE_NAME_NATIVE = 'Español';

    private static array $units = [
        0 => '',
        1 => 'uno',
        2 => 'dos',
        3 => 'tres',
        4 => 'cuatro',
        5 => 'cinco',
        6 => 'seis',
        7 => 'siete',
        8 => 'ocho',
        9 => 'nueve',
    ];

    private static array $teens = [
        0 => 'diez',
        1 => 'once',
        2 => 'doce',
        3 => 'trece',
        4 => 'catorce',
        5 => 'quince',
        6 => 'dieciseis',
        7 => 'diecisiete',
        8 => 'dieciocho',
        9 => 'diecinueve',
    ];

    private static array $tens = [
        0 => '',
        1 => 'diez',
        2 => 'veinte',
        3 => 'treinta',
        4 => 'cuarenta',
        5 => 'cincuenta',
        6 => 'sesenta',
        7 => 'setenta',
        8 => 'ochenta',
        9 => 'noventa',
    ];

    private static array $hundreds = [
        0 => '',
        1 => 'ciento', // will be "cien" for exactly 100
        2 => 'doscientos',
        3 => 'trescientos',
        4 => 'cuatrocientos',
        5 => 'quinientos',
        6 => 'seiscientos',
        7 => 'setecientos',
        8 => 'ochocientos',
        9 => 'novecientos',
    ];

    public function getZero(): string
    {
        return 'cero';
    }

    public function getMinus(): string
    {
        return 'menos';
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

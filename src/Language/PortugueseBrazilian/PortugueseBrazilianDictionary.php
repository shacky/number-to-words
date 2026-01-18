<?php

namespace NumberToWords\Language\PortugueseBrazilian;

use NumberToWords\Language\Dictionary;

class PortugueseBrazilianDictionary implements Dictionary
{
    public const LOCALE = 'pt_BR';
    public const LANGUAGE_NAME = 'Brazilian Portuguese';
    public const LANGUAGE_NAME_NATIVE = 'Português Brasileiro';

    private static array $units = [
        0 => '',
        1 => 'um',
        2 => 'dois',
        3 => 'três',
        4 => 'quatro',
        5 => 'cinco',
        6 => 'seis',
        7 => 'sete',
        8 => 'oito',
        9 => 'nove',
    ];

    private static array $teens = [
        0 => 'dez',
        1 => 'onze',
        2 => 'doze',
        3 => 'treze',
        4 => 'quatorze',
        5 => 'quinze',
        6 => 'dezesseis',
        7 => 'dezessete',
        8 => 'dezoito',
        9 => 'dezenove',
    ];

    private static array $tens = [
        0 => '',
        1 => 'dez',
        2 => 'vinte',
        3 => 'trinta',
        4 => 'quarenta',
        5 => 'cinquenta',
        6 => 'sessenta',
        7 => 'setenta',
        8 => 'oitenta',
        9 => 'noventa',
    ];

    private static array $hundreds = [
        0 => '',
        1 => 'cento',  // 'cem' for exactly 100 is handled in transformer
        2 => 'duzentos',
        3 => 'trezentos',
        4 => 'quatrocentos',
        5 => 'quinhentos',
        6 => 'seiscentos',
        7 => 'setecentos',
        8 => 'oitocentos',
        9 => 'novecentos',
    ];

    public function getZero(): string
    {
        return 'zero';
    }

    public function getMinus(): string
    {
        return 'negativo';
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

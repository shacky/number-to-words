<?php

namespace NumberToWords\Language\Italian;

use NumberToWords\Language\Dictionary;

class ItalianDictionary implements Dictionary
{
    public function getZero(): string
    {
        return 'zero';
    }

    public function getMinus(): string
    {
        return 'meno';
    }

    public function getCorrespondingUnit(int $unit): string
    {
        $units = [
            1 => 'uno',
            2 => 'due',
            3 => 'tre',
            4 => 'quattro',
            5 => 'cinque',
            6 => 'sei',
            7 => 'sette',
            8 => 'otto',
            9 => 'nove',
        ];

        return $units[$unit];
    }

    public function getCorrespondingTen(int $ten): string
    {
        $tens = [
            1 => 'dieci',
            2 => 'venti',
            3 => 'trenta',
            4 => 'quaranta',
            5 => 'cinquanta',
            6 => 'sessanta',
            7 => 'settanta',
            8 => 'ottanta',
            9 => 'novanta',
        ];

        return $tens[$ten];
    }

    public function getCorrespondingTeen(int $teen): string
    {
        $teens = [
            11 => 'undici',
            12 => 'dodici',
            13 => 'tredici',
            14 => 'quattordici',
            15 => 'quindici',
            16 => 'sedici',
            17 => 'diciassette',
            18 => 'diciotto',
            19 => 'diciannove',
        ];

        return $teens[$teen];
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        $hundreds = [
            1 => 'cento',
            2 => 'duecento',
            3 => 'trecento',
            4 => 'quattrocento',
            5 => 'cinquecento',
            6 => 'seicento',
            7 => 'settecento',
            8 => 'ottocento',
            9 => 'novecento',
        ];

        return $hundreds[$hundred];
    }
}

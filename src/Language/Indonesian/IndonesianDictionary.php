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

    public static array $currencyNames = [
        'ALL' => [['lek'], ['qindarka']],
        'AED' => [['dirham Uni Emirat Arab'], ['fils']],
        'AUD' => [['dolar Australia'], ['sen']],
        'BAM' => [['mark konvertibel'], ['fening']],
        'BGN' => [['lev Bulgaria'], ['stotinka']],
        'BRL' => [['real Brasil'], ['senavos']],
        'BYR' => [['rubel Belarus'], ['kopiejka']],
        'CAD' => [['dolar Kanada'], ['sen']],
        'CHF' => [['franc Swiss'], ['rappen']],
        'CYP' => [['paun Siprus'], ['sen']],
        'CZK' => [['koruna Ceko'], ['halerz']],
        'DKK' => [['krone Denmark'], ['øre']],
        'DZD' => [['dinar Aljazair'], ['sen']],
        'EEK' => [['kroon Estonia'], ['senti']],
        'EGP' => [['paun Mesir'], ['piastre']],
        'EUR' => [['euro'], ['sen euro']],
        'GBP' => [['pound', 'pounds'], ['pence', 'pence']],
        'HKD' => [['dolar Hong Kong'], ['sen']],
        'HRK' => [['kuna Kroasia'], ['lipa']],
        'HUF' => [['forint'], ['filler']],
        'IDR' => [['rupiah'], ['sen']],
        'ILS' => [['shekel baru Israel'], ['agora']],
        'ISK' => [['krona Islandia'], ['aurar']],
        'JPY' => [['yen'], ['sen']],
        'LTL' => [['litas Lituania'], ['sen']],
        'LVL' => [['lat'], ['sentim']],
        'LYD' => [['dinar Libya'], ['dirham']],
        'MAD' => [['dirham Maroko'], ['centime']],
        'MKD' => [['denar Makedonia'], ['deni']],
        'MRO' => [['ouguiya Mauritania'], ['khoums']],
        'MTL' => [['lira Malta'], ['senym']],
        'NGN' => [['naira'], ['kobo']],
        'NOK' => [['krone Norwegia'], ['øre']],
        'PHP' => [['peso'], ['senavo']],
        'PLN' => [['zloty'], ['grosz']],
        'ROL' => [['leu Rumania'], ['bani']],
        'RUB' => [['rubel Rusia'], ['kopeck']],
        'SAR' => [['riyal Saudi'], ['halalah']],
        'SEK' => [['krona Swedia'], ['öre']],
        'SIT' => [['tolar Slovenia'], ['stotin']],
        'SKK' => [['koruna Slovakia'], ['halier']],
        'TMT' => [['manat Turkmenistan'], ['tenge']],
        'TND' => [['dinar Tunisia'], ['millime']],
        'TRL' => [['lira'], ['kuruş']],
        'TRY' => [['lira'], ['kuruş']],
        'UAH' => [['hryvnia'], ['kopiyka']],
        'USD' => [['dolar'], ['sen']],
        'XAF' => [['franc CFA'], ['sen']],
        'XOF' => [['franc CFA'], ['sen']],
        'XPF' => [['franc CFP'], ['sen']],
        'YUM' => [['dinar'], ['para']],
        'ZAR' => [['rand'], ['sen']],
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

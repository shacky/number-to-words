<?php

namespace NumberToWords\Language\Malay;

use NumberToWords\Language\Dictionary;

class MalayDictionary implements Dictionary
{
    public const LOCALE = 'ms';
    public const LANGUAGE_NAME = 'Malay';
    public const LANGUAGE_NAME_NATIVE = 'Bahasa Melayu';

    private static array $units = [
        0 => '',
        1 => 'satu',
        2 => 'dua',
        3 => 'tiga',
        4 => 'empat',
        5 => 'lima',
        6 => 'enam',
        7 => 'tujuh',
        8 => 'lapan',
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
        8 => 'lapan belas',
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
        8 => 'lapan puluh',
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
        8 => 'lapan ratus',
        9 => 'sembilan ratus',
    ];

    public static array $currencyNames = [
        'ALL' => [['lek'], ['qindarka']],
        'AED' => [['dirham'], ['fils']],
        'AUD' => [['dolar Australia'], ['sen']],
        'BAM' => [['mark konvertibel'], ['fening']],
        'BGN' => [['lev Bulgaria'], ['stotinka']],
        'BRL' => [['real Brazil'], ['centavo']],
        'BYR' => [['rubel Belarus'], ['kopek']],
        'CAD' => [['dolar Kanada'], ['sen']],
        'CHF' => [['franc Swiss'], ['rappen']],
        'CYP' => [['paun Cyprus'], ['sen']],
        'CZK' => [['koruna Czech'], ['halerz']],
        'DKK' => [['krone Denmark'], ['øre']],
        'DZD' => [['dinar Algeria'], ['centime']],
        'EEK' => [['kroon Estonia'], ['senti']],
        'EGP' => [['paun Mesir'], ['piastre']],
        'EUR' => [['euro'], ['sen euro']],
        'GBP' => [['paun sterling'], ['pence']],
        'HKD' => [['dolar Hong Kong'], ['sen']],
        'HRK' => [['kuna Croatia'], ['lipa']],
        'HUF' => [['forint Hungary'], ['filler']],
        'IDR' => [['rupiah'], ['sen']],
        'ILS' => [['syekel baharu Israel'], ['agora']],
        'ISK' => [['króna Iceland'], ['aurar']],
        'JPY' => [['yen'], ['sen']],
        'LTL' => [['litas Lithuania'], ['cent']],
        'LVL' => [['lat Latvia'], ['santim']],
        'LYD' => [['dinar Libya'], ['dirham']],
        'MAD' => [['dirham Maghribi'], ['centime']],
        'MKD' => [['denar Macedonia'], ['deni']],
        'MRO' => [['ouguiya Mauritania'], ['khoums']],
        'MTL' => [['lira Malta'], ['centym']],
        'MYR' => [['ringgit'], ['sen']],
        'NGN' => [['naira'], ['kobo']],
        'NOK' => [['krone Norway'], ['øre']],
        'PHP' => [['peso'], ['centavo']],
        'PLN' => [['zloty'], ['grosz']],
        'ROL' => [['leu Romania'], ['bani']],
        'RUB' => [['rubel Rusia'], ['kopek']],
        'SAR' => [['riyal Saudi'], ['halalah']],
        'SEK' => [['krona Sweden'], ['öre']],
        'SIT' => [['tolar Slovenia'], ['stotin']],
        'SKK' => [['koruna Slovakia'], ['halier']],
        'TMT' => [['manat Turkmenistan'], ['tenge']],
        'TND' => [['dinar Tunisia'], ['millime']],
        'TRL' => [['lira Turki'], ['kuruş']],
        'TRY' => [['lira Turki'], ['kuruş']],
        'UAH' => [['hryvnia Ukraine'], ['kopiyka']],
        'USD' => [['dolar'], ['sen']],
        'XAF' => [['franc CFA'], ['centime']],
        'XOF' => [['franc CFA'], ['centime']],
        'XPF' => [['franc CFP'], ['centime']],
        'YUM' => [['dinar Yugoslavia'], ['para']],
        'ZAR' => [['rand'], ['sen']],
        'UZS' => [['sum Uzbekistan'], ['tiyin']],
    ];

    public function getZero(): string
    {
        return 'kosong';
    }

    public function getMinus(): string
    {
        return 'negatif';
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

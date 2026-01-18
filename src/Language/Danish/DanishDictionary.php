<?php

namespace NumberToWords\Language\Danish;

use NumberToWords\Language\Dictionary;

class DanishDictionary implements Dictionary
{
    public const LOCALE = 'dk';
    public const LANGUAGE_NAME = 'Danish';
    public const LANGUAGE_NAME_NATIVE = 'Dansk';

    private static array $units = [
        0 => '',
        1 => 'en',
        2 => 'to',
        3 => 'tre',
        4 => 'fire',
        5 => 'fem',
        6 => 'seks',
        7 => 'syv',
        8 => 'otte',
        9 => 'ni',
    ];

    private static array $teens = [
        0 => 'ti',
        1 => 'elleve',
        2 => 'tolv',
        3 => 'tretten',
        4 => 'fjorten',
        5 => 'femten',
        6 => 'seksten',
        7 => 'sytten',
        8 => 'atten',
        9 => 'nitten',
    ];

    private static array $tens = [
        0 => '',
        1 => 'ti',
        2 => 'tyve',
        3 => 'tredive',
        4 => 'fyrre',
        5 => 'halvtreds',
        6 => 'tres',
        7 => 'halvfjerds',
        8 => 'firs',
        9 => 'halvfems',
    ];
    public static $currencyNames = [
        'AED' => [['dirham'], ['fils']],
        'ALL' => [['lek'], ['qindarka']],
        'AUD' => [['australsk dollar', 'australske dollars'], ['cent']],
        'BAM' => [['konvertibel mark'], ['fening']],
        'BGN' => [['bulgarsk lev'], ['stotinki']],
        'BRL' => [['brasiliansk real'], ['centavo']],
        'BYR' => [['hviderussisk rubel'], ['kopeke']],
        'CAD' => [['canadisk dollar', 'canadiske dollars'], ['cent']],
        'CHF' => [['schweitzer franc'], ['rappen']],
        'CYP' => [['cypriotisk pund'], ['cent']],
        'CZK' => [['tjekkisk koruna'], ['halerz']],
        'DKK' => [['krone', 'kroner'], ['øre']],
        'DZD' => [['algerisk dinar'], ['centime']],
        'EEK' => [['estisk kroon'], ['senti']],
        'EGP' => [['egyptisk pund'], ['piastre']],
        'EUR' => [['euro'], ['euro-cent']],
        'GBP' => [['pund'], ['pence']],
        'HKD' => [['Hong Kong dollar', 'Hong Kong dollars'], ['cent']],
        'HRK' => [['kroatisk kuna'], ['lipa']],
        'HUF' => [['ungarsk forint'], ['fillér']],
        'IDR' => [['indonesisk rupiah'], ['sen']],
        'ILS' => [['ny israelsk shekel'], ['agora']],
        'ISK' => [['islandsk krone'], ['aurar']],
        'JPY' => [['yen'], ['sen']],
        'LTL' => [['litauisk litas'], ['centas']],
        'LVL' => [['lettisk lat'], ['santim']],
        'LYD' => [['libysk dinar'], ['dirham']],
        'MAD' => [['marokkansk dirham'], ['centime']],
        'MKD' => [['makedonsk denar'], ['deni']],
        'MRO' => [['mauritansk ouguiya'], ['khoums']],
        'MTL' => [['maltesisk lira'], ['centim']],
        'MYR' => [['malaysisk ringgit'], ['sen']],
        'NGN' => [['nigeriansk naira'], ['kobo']],
        'NOK' => [['norsk krone', 'norske kroner'], ['øre']],
        'PHP' => [['filippinsk peso'], ['centavo']],
        'PLN' => [['zloty'], ['grosz']],
        'ROL' => [['rumænsk leu'], ['bani']],
        'RUB' => [['russisk rubel'], ['kopeke']],
        'SAR' => [['saudiarabisk riyal'], ['halala']],
        'SEK' => [['svensk krone', 'svenske kroner'], ['öre']],
        'SIT' => [['slovensk tolar'], ['stotin']],
        'SKK' => [['slovakisk koruna'], ['halier']],
        'TMT' => [['turkmensk manat'], ['tenge']],
        'TND' => [['tunesiske dinar'], ['millime']],
        'TRL' => [['tyrkisk lira'], ['kuruş']],
        'TRY' => [['tyrkisk lira'], ['kuruş']],
        'UAH' => [['ukrainsk hryvnia'], ['kopiyka']],
        'USD' => [['dollar', 'dollars'], ['cent']],
        'XAF' => [['CFA-franc'], ['centime']],
        'XOF' => [['CFA-franc'], ['centime']],
        'XPF' => [['CFP-franc'], ['centime']],
        'YUM' => [['jugoslavisk dinar'], ['para']],
        'ZAR' => [['sydafrikansk rand'], ['cent']],
        'UZS' => [['usbekisk sum'], ['tiyin']],
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

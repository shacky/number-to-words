<?php

namespace NumberToWords\Language\Turkish;

use NumberToWords\Language\Dictionary;

class TurkishDictionary implements Dictionary
{
    public const LOCALE = 'tr';
    public const LANGUAGE_NAME = 'Turkish';
    public const LANGUAGE_NAME_NATIVE = 'Türkçe';

    private static array $units = [
        0 => '',
        1 => 'bir',
        2 => 'iki',
        3 => 'üç',
        4 => 'dört',
        5 => 'beş',
        6 => 'altı',
        7 => 'yedi',
        8 => 'sekiz',
        9 => 'dokuz',
    ];

    private static array $tens = [
        0 => '',
        1 => 'on',
        2 => 'yirmi',
        3 => 'otuz',
        4 => 'kırk',
        5 => 'elli',
        6 => 'altmış',
        7 => 'yetmiş',
        8 => 'seksen',
        9 => 'doksan',
    ];
    public static $currencyNames = [
        'ALL' => [['Arnavut leki'], ['qindarka']],
        'AUD' => [['Avusturalya doları'], ['sent']],
        'BAM' => [['Bosna-Hersek değiştirilebilir markı'], ['fenig']],
        'BGN' => [['Bulgar levası'], ['stotinka']],
        'BRL' => [['Brezilya reali'], ['centavos']],
        'BWP' => [['Botswana pulası'], ['thebe']],
        'BYR' => [['Belarus rublesi'], ['kopiejka']],
        'CAD' => [['Kanada doları'], ['sent']],
        'CHF' => [['İsviçre frangı'], ['rapp']],
        'CNY' => [['Çin yuanı'], ['fen']],
        'CYP' => [['Kıbrıs poundu'], ['sent']],
        'CZK' => [['Çek kronu'], ['halerz']],
        'DKK' => [['Danimarka kronu'], ['ore']],
        'EEK' => [['Estonya kronu'], ['senti']],
        'EUR' => [['avro'], ['sent']],
        'GBP' => [['pound'], ['pence']],
        'HKD' => [['Hong Kong doları'], ['sent']],
        'HRK' => [['Hırvatistan kunası'], ['lipa']],
        'HUF' => [['Macar forinti'], ['filler']],
        'ILS' => [['İsrail şekeli'], ['agora']],
        'ISK' => [['Izlanda kronu'], ['aurar']],
        'JPY' => [['Japon yeni'], ['sen']],
        'LTL' => [['Litvanya litası'], ['sent']],
        'LVL' => [['Letonya latı'], ['sentim']],
        'MKD' => [['Makedonya dinarı'], ['deni']],
        'MTL' => [['Malta lirası'], ['centym']],
        'NOK' => [['Norveç kronu'], ['oere']],
        'PLN' => [['Polonya zlotisi'], ['grosz']],
        'RON' => [['Roman leyi'], ['bani']],
        'RUB' => [['Rus rublesi'], ['kopiejka']],
        'SEK' => [['İsveç kronu'], ['oere']],
        'SIT' => [['Slovenya toları'], ['stotinia']],
        'SKK' => [['Slovakya kronu'], ['']],
        'TRL' => [['Türk lirası'], ['kuruş']],
        'TRY' => [['Türk lirası'], ['kuruş']],
        'UAH' => [['Ukrayna hryvnyası'], ['kopiyka']],
        'USD' => [['ABD doları'], ['sent']],
        'YUM' => [['Yugoslav dinarı'], ['para']],
        'ZAR' => [['Güney Afrika randı'], ['sent']]
    ];



    public function getZero(): string
    {
        return 'sıfır';
    }

    public function getMinus(): string
    {
        return 'eksi';
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
        // Turkish doesn't have special teen words, just "on" + unit
        return '';
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        // Turkish doesn't use this - hundreds are handled differently
        return '';
    }
}

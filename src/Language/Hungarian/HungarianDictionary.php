<?php

namespace NumberToWords\Language\Hungarian;

use NumberToWords\Language\Dictionary;

class HungarianDictionary implements Dictionary
{
    public const LOCALE = 'hu';
    public const LANGUAGE_NAME = 'Hungarian';
    public const LANGUAGE_NAME_NATIVE = 'Magyar';

    private static array $units = [
        0 => '',
        1 => 'egy',
        2 => 'kettő',
        3 => 'három',
        4 => 'négy',
        5 => 'öt',
        6 => 'hat',
        7 => 'hét',
        8 => 'nyolc',
        9 => 'kilenc',
    ];
    public static $currencyNames = [
        'ALL' => [['lek'], ['qindarke']],
        'AUD' => [['ausztrál dollár'], ['cent']],
        'BAM' => [['konvertibilis márka'], ['pfening']],
        'BGN' => [['leva'], ['sztotinka']],
        'BRL' => [['real'], ['centavo']],
        'BYR' => [['belarusz rubel'], ['kopejka']],
        'BYN' => [['belarusz rubel'], ['kopejka']],
        'CAD' => [['kanadai dollár'], ['cent']],
        'CHF' => [['svájci frank'], ['rappen']],
        'CYP' => [['ciprusi font'], ['cent']],
        'CZK' => [['cseh korona'], ['halér']],
        'DKK' => [['dán korona'], ['őre']],
        'EEK' => [['észt korona'], ['sent']],
        'EUR' => [['euró'], ['cent']],
        'GBP' => [['font'], ['penny']],
        'HKD' => [['hongkongi dollár'], ['cent']],
        'HRK' => [['kuna'], ['lipa']],
        'HUF' => [['forint'], ['fillér']],
        'ILS' => [['sékel'], ['agora']],
        'ISK' => [['izlandi korona'], ['aurar']],
        'JPY' => [['jen'], ['szen']],
        'LTL' => [['litas'], ['cent']],
        'LVL' => [['lat'], ['santim']],
        'MKD' => [['macedón dénár'], ['deni']],
        'MTL' => [['máltai líra'], ['cent']],
        'NOK' => [['norvég korona'], ['őre']],
        'PLN' => [['zloty'], ['grosz']],
        'ROL' => [['lej'], ['bani']],
        'RUB' => [['orosz rubel'], ['kopejka']],
        'SEK' => [['svéd korona'], ['őre']],
        'SIT' => [['tolár'], ['sztotin']],
        'TRL' => [['lira'], ['kuruþ']],
        'TRY' => [['lira'], ['kuruþ']],
        'UAH' => [['hrivnya'], ['kopejka']],
        'USD' => [['dollár'], ['cent']],
        'ZAR' => [['rand'], ['cent']]
    ];



    public function getZero(): string
    {
        return 'nulla';
    }

    public function getMinus(): string
    {
        return 'mínusz';
    }

    public function getCorrespondingUnit(int $unit): string
    {
        return self::$units[$unit];
    }

    public function getCorrespondingTen(int $ten): string
    {
        // Hungarian tens are irregular and handled in transformer
        return '';
    }

    public function getCorrespondingTeen(int $teen): string
    {
        // Hungarian teens are handled in transformer (tizen + unit)
        return '';
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        // Hungarian hundreds are handled in transformer (unit + száz)
        return '';
    }
}

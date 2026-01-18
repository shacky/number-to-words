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
    public static $currencyNames = [
        'PEN' => [['sol', 'soles'], ['centavo']],
        'ALL' => [['lek'], ['qindarka']],
        'AUD' => [['dólar australiano', 'dólares australianos'], ['centavo']],
        'ARS' => [['peso'], ['centavo']],
        'BAM' => [['convertible marka'], ['fenig']],
        'BGN' => [['lev'], ['stotinka']],
        'BRL' => [['real', 'reales'], ['centavo']],
        'BYR' => [['rublo bielorruso', 'rublos bielorrusos'], ['kopek', 'kopeks']],
        'CAD' => [['dólar canadiense', 'dólares canadienses'], ['centavo']],
        'CHF' => [['swiss franc'], ['rapp']],
        'COP' => [['peso', 'pesos'], ['centavo', 'centavos']],
        'CYP' => [['cypriot pound'], ['cent']],
        'CZK' => [['czech koruna', 'czech korunas'], ['halerz', 'halerzs']],
        'CRC' => [['colón', 'colones'], ['centavo']],
        'DZD' => [['dinar', 'dinares'], ['céntimo']],
        'DKK' => [['danish krone'], ['ore']],
        'DOP' => [['peso dominicano', 'pesos dominicanos'], ['centavo', 'centavos']],
        'EEK' => [['kroon'], ['senti']],
        'EUR' => [['euro', 'euros'], ['centavo', 'centavos']],
        'GBP' => [['libra'], ['peñique']],
        'HKD' => [['dólar de hong kong', 'dólares de hong kong'], ['centavo']],
        'HRK' => [['croatian kuna'], ['lipa']],
        'HUF' => [['forint'], ['filler']],
        'ILS' => [['new sheqel', 'new sheqels'], ['agora', 'agorot']],
        'ISK' => [['icelandic króna'], ['aurar']],
        'JPY' => [['yen', 'yenes'], ['sen']],
        'LTL' => [['litas'], ['cent']],
        'LVL' => [['lat'], ['sentim']],
        'LYD' => [['dinar', 'dinares'], ['céntimo']],
        'MAD' => [['dírham'], ['céntimo']],
        'MKD' => [['denar macedonio', 'denares macedonios'], ['deni']],
        'MRO' => [['ouguiya'], ['khoums']],
        'MTL' => [['lira maltesa'], ['céntimo']],
        'MXN' => [['peso'], ['centavo']],
        'NOK' => [['norwegian krone', 'norwegian krones'], ['oere', 'oeres']],
        'PAB' => [['balboa', 'balboas'], ['centavo', 'centavos']],
        'PLN' => [['zloty', 'zlotys'], ['grosz']],
        'RON' => [['romanian leu'], ['bani']],
        'RUB' => [['rublo ruso', 'rublos rusos'], ['kopek']],
        'SEK' => [['Swedish krona'], ['oere']],
        'SIT' => [['tolar'], ['stotinia']],
        'SKK' => [['slovak koruna'], []],
        'TND' => [['dinar', 'dinares'], ['milímetrs']],
        'TRL' => [['lira'], ['kuruþ']],
        'TRY' => [['lira'], ['kuruþ']],
        'UAH' => [['hryvna'], ['cent']],
        'USD' => [['dólar', 'dólares'], ['centavo', 'centavos']],
        'UYU' => [['peso uruguayo', 'pesos uruguayos'], ['centavo']],
        'VEB' => [['bolívar', 'bolívares'], ['céntimo']],
        'XAF' => [['franco CFA', 'francos CFA'], ['céntimo']],
        'XOF' => [['franco CFA', 'francos CFA'], ['céntimo']],
        'YUM' => [['dinar', 'dinares'], ['para']],
        'ZAR' => [['rand'], ['cent']]
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

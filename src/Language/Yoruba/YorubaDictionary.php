<?php

namespace NumberToWords\Language\Yoruba;

use NumberToWords\Language\Dictionary;

class YorubaDictionary implements Dictionary
{
    public const LOCALE = 'yo';
    public const LANGUAGE_NAME = 'Yoruba';
    public const LANGUAGE_NAME_NATIVE = 'Yorùbá';

    private static array $units = [
        0 => '',
        1 => 'ọkan',
        2 => 'meji',
        3 => 'mẹta',
        4 => 'mẹrin',
        5 => 'marun',
        6 => 'mẹfa',
        7 => 'meje',
        8 => 'mẹjọ',
        9 => 'mẹsan',
    ];

    private static array $teens = [
        10 => 'mẹwa',
        11 => 'mọkanla',
        12 => 'mejila',
        13 => 'mẹtala',
        14 => 'mẹrinla',
        15 => 'mẹẹdogun',
        16 => 'mẹrindilogun',
        17 => 'mẹtala',
        18 => 'mejidilogun',
        19 => 'mọkandinlogun',
    ];

    private static array $tens = [
        0 => '',
        1 => '',
        2 => 'ogun',
        3 => 'ọgbọn',
        4 => 'ogoji',
        5 => 'aadọta',
        6 => 'Ogota',
        7 => 'aadọrin',
        8 => 'ọgọrin',
        9 => 'aadọrun',
    ];

    private static array $hundreds = [
        0 => '',
        1 => 'ọgọrun',
        2 => 'igba',
        3 => 'ọ̀ọ́dúrún',
        4 => 'irinwó',
        5 => 'ẹdẹgbẹta',
        6 => 'ẹgbẹta',
        7 => 'ẹẹdẹgbẹrin',
        8 => 'ẹgbẹ̀rin',
        9 => 'ẹ̀ẹ́dẹ́gbẹ̀rún',
    ];

    public static array $currencyNames = [
        'AED' => [['Dirham Ara ilẹ̀ Arabu', 'Dirham Ara ilẹ̀ Arabu'], ['fils', 'fils']],
        'ALL' => [['Lek Albania', 'Lek Albania'], ['qindarka', 'qindarka']],
        'AUD' => [['Dọla Ọstrelia', 'Dọla Ọstrelia'], ['senti', 'senti']],
        'BAM' => [['Marka Bosnia', 'Marka Bosnia'], ['fening', 'fening']],
        'BGN' => [['Lev Bulgaria', 'Lev Bulgaria'], ['stotinka', 'stotinka']],
        'BRL' => [['Reali Brazil', 'Reali Brazil'], ['sentavo', 'sentavo']],
        'BYR' => [['Rubu Belarus', 'Rubu Belarus'], ['kopek', 'kopek']],
        'CAD' => [['Dọla Kanada', 'Dọla Kanada'], ['senti', 'senti']],
        'CHF' => [['Faransi Suwisi', 'Faransi Suwisi'], ['senti', 'senti']],
        'CNY' => [['Yuan Ṣáínà', 'Yuan Ṣáínà'], ['feni', 'feni']],
        'CYP' => [['Pọọndu Siprɔsi', 'Pọọndu Siprɔsi'], ['senti', 'senti']],
        'CZK' => [['Koruna Ṣẹ́ẹ̀kì', 'Koruna Ṣẹ́ẹ̀kì'], ['halerz', 'halerz']],
        'DKK' => [['Krone Dẹ́mákì', 'Krone Dẹ́mákì'], ['ore', 'ore']],
        'DZD' => [['Dina Algeria', 'Dina Algeria'], ['senti', 'senti']],
        'EEK' => [['Kroon Estonia', 'Kroon Estonia'], ['senti', 'senti']],
        'EGP' => [['Pọọndu Ejipiti', 'Pọọndu Ejipiti'], ['piastre', 'piastre']],
        'EUR' => [['Yuro', 'Yuro'], ['senti', 'senti']],
        'GBP' => [['Pọọndu Gẹẹsi', 'Pọọndu Gẹẹsi'], ['pensì', 'pensì']],
        'HKD' => [['Dọla Hong Kong', 'Dọla Hong Kong'], ['senti', 'senti']],
        'HRK' => [['Kuna Kroatia', 'Kuna Kroatia'], ['lipa', 'lipa']],
        'HUF' => [['Forint Hungaria', 'Forint Hungaria'], ['filler', 'filler']],
        'IDR' => [['Rupiah Indonesia', 'Rupiah Indonesia'], ['sen', 'sen']],
        'ILS' => [['Shekel Israeli', 'Shekel Israeli'], ['agora', 'agora']],
        'ISK' => [['Krona Aisilandi', 'Krona Aisilandi'], ['aurar', 'aurar']],
        'JPY' => [['Yen Japan', 'Yen Japan'], ['sen', 'sen']],
        'LTL' => [['Litas Lithuania', 'Litas Lithuania'], ['senti', 'senti']],
        'LVL' => [['Lat Latvia', 'Lat Latvia'], ['santim', 'santim']],
        'LYD' => [['Dina Libiya', 'Dina Libiya'], ['dirham', 'dirham']],
        'MAD' => [['Dirham Moroko', 'Dirham Moroko'], ['senti', 'senti']],
        'MKD' => [['Denar Macedonia', 'Denar Macedonia'], ['deni', 'deni']],
        'MRO' => [['Ouguiya Moritania', 'Ouguiya Moritania'], ['khoums', 'khoums']],
        'MTL' => [['Lira Malta', 'Lira Malta'], ['centym', 'centym']],
        'MYR' => [['Ringgit Malaysia', 'Ringgit Malaysia'], ['sen', 'sen']],
        'MXN' => [['Peso Mẹ́síkò', 'Peso Mẹ́síkò'], ['sentavo', 'sentavo']],
        'NGN' => [['Naira', 'Naira'], ['kobo', 'kobo']],
        'NOK' => [['Krone Norway', 'Krone Norway'], ['ore', 'ore']],
        'PHP' => [['Peso Filipaini', 'Peso Filipaini'], ['sentavo', 'sentavo']],
        'PLN' => [['Zloty Polandi', 'Zloty Polandi'], ['grosz', 'grosz']],
        'RON' => [['Leu Romania', 'Leu Romania'], ['bani', 'bani']],
        'RUB' => [['Rubu Rọ́ṣíà', 'Rubu Rọ́ṣíà'], ['kopek', 'kopek']],
        'SAR' => [['Riyal Saudi', 'Riyal Saudi'], ['halala', 'halala']],
        'SEK' => [['Krona Suwidi', 'Krona Suwidi'], ['ore', 'ore']],
        'SIT' => [['Tolar Slovenia', 'Tolar Slovenia'], ['stotin', 'stotin']],
        'SKK' => [['Koruna Slovakia', 'Koruna Slovakia'], ['halier', 'halier']],
        'TMT' => [['Manat Tọ́kimenisítàànì', 'Manat Tọ́kimenisítàànì'], ['tenge', 'tenge']],
        'TND' => [['Dina Tunisia', 'Dina Tunisia'], ['millime', 'millime']],
        'TRL' => [['Lira Tọọki', 'Lira Tọọki'], ['kurus', 'kurus']],
        'TRY' => [['Lira Tọọki', 'Lira Tọọki'], ['kurus', 'kurus']],
        'UAH' => [['Hryvnia Ukarini', 'Hryvnia Ukarini'], ['kopiyka', 'kopiyka']],
        'USD' => [['Dọla Amerika', 'Dọla Amerika'], ['senti', 'senti']],
        'XAF' => [['Faransi CFA', 'Faransi CFA'], ['senti', 'senti']],
        'XOF' => [['Faransi CFA', 'Faransi CFA'], ['senti', 'senti']],
        'XPF' => [['Faransi CFP', 'Faransi CFP'], ['senti', 'senti']],
        'YUM' => [['Dina Yugoslafia', 'Dina Yugoslafia'], ['para', 'para']],
        'ZAR' => [['Rand Ariwa Afirika', 'Rand Ariwa Afirika'], ['senti', 'senti']],
        'UZS' => [['Som Uṣibẹkisitani', 'Som Uṣibẹkisitani'], ['tiyin', 'tiyin']],
    ];

    public function getZero(): string
    {
        return 'odo';
    }

    public function getMinus(): string
    {
        return 'iyokuro';
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

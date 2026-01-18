<?php

namespace NumberToWords\Language\Swahili;

use NumberToWords\Language\Dictionary;

class SwahiliDictionary implements Dictionary
{
    public const LOCALE = 'sw';
    public const LANGUAGE_NAME = 'Swahili';
    public const LANGUAGE_NAME_NATIVE = 'Kiswahili';

    private static array $units = [
        0 => '',
        1 => 'moja',
        2 => 'mbili',
        3 => 'tatu',
        4 => 'nne',
        5 => 'tano',
        6 => 'sita',
        7 => 'saba',
        8 => 'nane',
        9 => 'tisa',
    ];

    private static array $tens = [
        0 => '',
        1 => 'kumi',
        2 => 'ishirini',
        3 => 'thelathini',
        4 => 'arobaini',
        5 => 'hamsini',
        6 => 'sitini',
        7 => 'sabini',
        8 => 'themanini',
        9 => 'tisini',
    ];

    private static array $hundreds = [
        0 => '',
        1 => 'mia',
        2 => 'mia mbili',
        3 => 'mia tatu',
        4 => 'mia nne',
        5 => 'mia tano',
        6 => 'mia sita',
        7 => 'mia saba',
        8 => 'mia nane',
        9 => 'mia tisa',
    ];

    public static array $currencyNames = [
        'AED' => [['Dirham ya Umoja wa Falme za Kiarabu', 'Dirham za Umoja wa Falme za Kiarabu'], ['fils', 'fils']],
        'ALL' => [['Lek ya Albania', 'Lek za Albania'], ['qindarka', 'qindarka']],
        'AUD' => [['Dola ya Australia', 'Dola za Australia'], ['senti', 'senti']],
        'BAM' => [['Marka ya Bosnia na Herzegovina', 'Marka za Bosnia na Herzegovina'], ['fening', 'fening']],
        'BGN' => [['Lev ya Bulgaria', 'Lev za Bulgaria'], ['stotinka', 'stotinka']],
        'BRL' => [['Reali ya Brazil', 'Reali za Brazil'], ['sentavo', 'sentavo']],
        'BWP' => [['Pula ya Botswana', 'Pula za Botswana'], ['thebe', 'thebe']],
        'BYR' => [['Rubel ya Belarus', 'Rubel za Belarus'], ['kopek', 'kopek']],
        'CAD' => [['Dola ya Kanada', 'Dola za Kanada'], ['senti', 'senti']],
        'CHF' => [['Faranga ya Uswisi', 'Faranga za Uswisi'], ['senti', 'senti']],
        'CNY' => [['Yuan ya China', 'Yuan za China'], ['feni', 'feni']],
        'CYP' => [['Pauni ya Cyprus', 'Pauni za Cyprus'], ['senti', 'senti']],
        'CZK' => [['Koruna ya Czech', 'Koruna za Czech'], ['halerz', 'halerz']],
        'DKK' => [['Krone ya Denmark', 'Krone za Denmark'], ['ore', 'ore']],
        'DZD' => [['Dinar ya Algeria', 'Dinar za Algeria'], ['senti', 'senti']],
        'EEK' => [['Kroon ya Estonia', 'Kroon za Estonia'], ['senti', 'senti']],
        'EGP' => [['Pauni ya Misri', 'Pauni za Misri'], ['piastre', 'piastre']],
        'EUR' => [['Yuro', 'Yuro'], ['senti', 'senti']],
        'GBP' => [['Pauni ya Uingereza', 'Pauni za Uingereza'], ['senti', 'senti']],
        'GHS' => [['Cedi ya Ghana', 'Cedi za Ghana'], ['pesewa', 'pesewa']],
        'HKD' => [['Dola ya Hong Kong', 'Dola za Hong Kong'], ['senti', 'senti']],
        'HRK' => [['Kuna ya Croatia', 'Kuna za Croatia'], ['lipa', 'lipa']],
        'HUF' => [['Forint ya Hungary', 'Forint za Hungary'], ['filler', 'filler']],
        'IDR' => [['Rupiah ya Indonesia', 'Rupiah za Indonesia'], ['sen', 'sen']],
        'ILS' => [['Shekel mpya ya Israeli', 'Shekel mpya za Israeli'], ['agora', 'agora']],
        'INR' => [['Rupia ya India', 'Rupia za India'], ['paise', 'paise']],
        'ISK' => [['Krona ya Iceland', 'Krona za Iceland'], ['aurar', 'aurar']],
        'JPY' => [['Yen ya Japani', 'Yen za Japani'], ['seni', 'seni']],
        'KES' => [['Shilingi ya Kenya', 'Shilingi za Kenya'], ['senti', 'senti']],
        'LTL' => [['Litas ya Lithuania', 'Litas za Lithuania'], ['senti', 'senti']],
        'LVL' => [['Lat ya Latvia', 'Lat za Latvia'], ['santim', 'santim']],
        'LYD' => [['Dinar ya Libya', 'Dinar za Libya'], ['dirham', 'dirham']],
        'MAD' => [['Dirham ya Moroko', 'Dirham za Moroko'], ['centime', 'centime']],
        'MKD' => [['Denar ya Macedonia', 'Denar za Macedonia'], ['deni', 'deni']],
        'MRO' => [['Ouguiya ya Mauritania', 'Ouguiya za Mauritania'], ['khoums', 'khoums']],
        'MTL' => [['Lira ya Malta', 'Lira za Malta'], ['centym', 'centym']],
        'MXN' => [['Peso ya Meksiko', 'Peso za Meksiko'], ['sentavo', 'sentavo']],
        'MYR' => [['Ringgit ya Malaysia', 'Ringgit za Malaysia'], ['sen', 'sen']],
        'NGN' => [['Naira ya Nigeria', 'Naira za Nigeria'], ['kobo', 'kobo']],
        'NOK' => [['Krone ya Norway', 'Krone za Norway'], ['ore', 'ore']],
        'PHP' => [['Peso ya Ufilipino', 'Peso za Ufilipino'], ['sentavo', 'sentavo']],
        'PLN' => [['Zloty ya Poland', 'Zloty za Poland'], ['grosz', 'grosz']],
        'RON' => [['Leu ya Romania', 'Leu za Romania'], ['bani', 'bani']],
        'RUB' => [['Rubel ya Urusi', 'Rubel za Urusi'], ['kopek', 'kopek']],
        'RWF' => [['Faranga ya Rwanda', 'Faranga za Rwanda'], ['senti', 'senti']],
        'SAR' => [['Riyal ya Saudia', 'Riyal za Saudia'], ['halala', 'halala']],
        'SEK' => [['Krona ya Sweden', 'Krona za Sweden'], ['ore', 'ore']],
        'SIT' => [['Tolar ya Slovenia', 'Tolar za Slovenia'], ['stotin', 'stotin']],
        'SKK' => [['Koruna ya Slovakia', 'Koruna za Slovakia'], ['halier', 'halier']],
        'TMT' => [['Manat ya Turkmenistan', 'Manat za Turkmenistan'], ['tenge', 'tenge']],
        'TND' => [['Dinar ya Tunisia', 'Dinar za Tunisia'], ['millime', 'millime']],
        'TRL' => [['Lira ya Uturuki', 'Lira za Uturuki'], ['kurus', 'kurus']],
        'TRY' => [['Lira ya Uturuki', 'Lira za Uturuki'], ['kurus', 'kurus']],
        'TZS' => [['Shilingi ya Tanzania', 'Shilingi za Tanzania'], ['senti', 'senti']],
        'UAH' => [['Hryvnia ya Ukraine', 'Hryvnia za Ukraine'], ['kopiyka', 'kopiyka']],
        'UGX' => [['Shilingi ya Uganda', 'Shilingi za Uganda'], ['senti', 'senti']],
        'USD' => [['Dola ya Marekani', 'Dola za Marekani'], ['senti', 'senti']],
        'UZS' => [['Som ya Uzbekistan', 'Som za Uzbekistan'], ['tiyin', 'tiyin']],
        'XAF' => [['Faranga ya CFA', 'Faranga za CFA'], ['centime', 'centime']],
        'XOF' => [['Faranga ya CFA', 'Faranga za CFA'], ['centime', 'centime']],
        'XPF' => [['Faranga ya CFP', 'Faranga za CFP'], ['centime', 'centime']],
        'YUM' => [['Dinar ya Yugoslavia', 'Dinar za Yugoslavia'], ['para', 'para']],
        'ZAR' => [['Randi ya Afrika Kusini', 'Randi za Afrika Kusini'], ['senti', 'senti']],
    ];

    public function getZero(): string
    {
        return 'sifuri';
    }

    public function getMinus(): string
    {
        return 'kasoro';
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
        return self::$tens[1] . ' na ' . self::$units[$teen];
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        return self::$hundreds[$hundred];
    }
}

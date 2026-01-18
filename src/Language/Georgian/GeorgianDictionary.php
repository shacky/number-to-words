<?php

namespace NumberToWords\Language\Georgian;

use NumberToWords\Language\Dictionary;

class GeorgianDictionary implements Dictionary
{
    public const LOCALE = 'ka';
    public const LANGUAGE_NAME = 'Georgian';
    public const LANGUAGE_NAME_NATIVE = 'ქართული';

    public const SUFFIX = 'ი';
    public const CONJUNCTION = 'და';

    private static array $units = [
        0 => 'ნულ',
        1 => 'ერთ',
        2 => 'ორ',
        3 => 'სამ',
        4 => 'ოთხ',
        5 => 'ხუთ',
        6 => 'ექვს',
        7 => 'შვიდ',
        8 => 'რვა',
        9 => 'ცხრა',
    ];

    private static array $teens = [
        10 => 'ათ',
        11 => 'თერთმეტ',
        12 => 'თორმეტ',
        13 => 'ცამეტ',
        14 => 'თოთხმეტ',
        15 => 'თხუთმეტ',
        16 => 'თექვსმეტ',
        17 => 'ჩვიდმეტ',
        18 => 'თვრამეტ',
        19 => 'ცხრამეტ',
    ];

    private static array $twenties = [
        20 => 'ოც',
        40 => 'ორმოც',
        60 => 'სამოც',
        80 => 'ოთხმოც',
    ];

    private static array $exponents = [
        0 => '',
        1 => 'ათას',
        2 => 'მილიონ',
        3 => 'მილიარდ',
        4 => 'ტრილიონ',
        5 => 'კვადრილიონ',
        6 => 'კვინტილიონ',
    ];

    public static array $currencyNames = [
        'GEL' => [['ლარი', 'ლარი'], ['თეთრი', 'თეთრი']],
        'TRY' => [['ლირა', 'ლირა'], ['ყურუში', 'ყურუში']],
        'PLN' => [['ზლოტი', 'ზლოტი'], ['გროში', 'გროში']],
        'USD' => [['დოლარი', 'დოლარი'], ['ცენტი', 'ცენტი']],
        'AMD' => [['დრამი', 'დრამი'], ['ლუმა', 'ლუმა']],
        'EUR' => [['ევრო', 'ევრო'], ['ცენტი', 'ცენტი']],
        'GBP' => [['ფუნტ სტერლინგი', 'ფუნტ სტერლინგი'], ['პენსი', 'პენსი']],
        'ALL' => [['ლეკი', 'ლეკი'], ['კინდარკა', 'კინდარკა']],
        'NOK' => [['ნორვეგიული კრონი', 'ნორვეგიული კრონი'], ['ერე', 'ერე']],
    ];

    public function getZero(): string
    {
        return self::$units[0] . self::SUFFIX;
    }

    public function getMinus(): string
    {
        return 'მინუს';
    }

    public function getCorrespondingUnit(int $unit): string
    {
        return self::$units[$unit] ?? '';
    }

    public function getCorrespondingTen(int $ten): string
    {
        return '';
    }

    public function getCorrespondingTeen(int $teen): string
    {
        return self::$teens[$teen] ?? '';
    }

    public function getCorrespondingHundred(int $hundred): string
    {
        return 'ას';
    }

    public function getCorrespondingTwenty(int $twenty): string
    {
        return self::$twenties[$twenty] ?? '';
    }

    public function getExponent(int $power): string
    {
        return self::$exponents[$power] ?? '';
    }

    public function getConjunction(): string
    {
        return self::CONJUNCTION;
    }

    public function getSuffix(): string
    {
        return self::SUFFIX;
    }
}
